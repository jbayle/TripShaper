<?php

namespace TripShaper\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use TripShaper\StoreBundle\Document\Trip;
use TripShaper\StoreBundle\Document\Place;
use TripShaper\StoreBundle\Document\Resource;
use TripShaper\StoreBundle\Document\LocalizedString;
use TripShaper\StoreBundle\Document\Geolocation;
use TripShaper\StoreBundle\Document\Asset;

class ImportTourMLCommand extends ContainerAwareCommand
{
	private $document;
	private $directory;
	private $dm;

    protected function configure()
    {
        $this
            ->setName('tripshaper:import')
            ->setDescription('Import TourML')
            ->addArgument('file', InputArgument::REQUIRED, 'The file to import')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$file = $input->getArgument('file');
	    if (!is_file($file)) throw new \Exception('Unkown file');

	    $this->document = new \DOMDocument('1.0', 'UTF-8');
	    if (false === $this->document->load($file)) throw new \Exception('Error in XML');

	    $path_parts = pathinfo(realpath($file));
	    $this->directory = $path_parts['dirname'];

	    $this->dm = $this->getContainer()->get('doctrine.odm.mongodb.document_manager');

	    $nodes = $this->document->getElementsByTagName('Stop');
	    foreach($nodes as $node)
			$this->persistStop($node);

	    $this->dm->flush();

    }

	private function persistStop(\DomElement $element)
	{
		if (!$element->hasAttribute('tourml:view'))
			return;

		if ('StopGroup' == $element->getAttribute('tourml:view'))
			return $this->persistPlace($element);

		if (('AudioStop' == $element->getAttribute('tourml:view')) ||
			('ImageStop' == $element->getAttribute('tourml:view')))
			return $this->persistResource($element);
	}

	private function persistPlace(\DomElement $element)
	{
		$place = new Place();

    	$place->setTitles($this->getLocalizedProperty($element, 'Title'));

    	$geolocation = new Geolocation();
    	$props = $element->getElementsByTagName('PropertySet');
    	foreach($props as $prop)
    	{
    		$subprops = $element->getElementsByTagName('Property');
    		foreach($subprops as $subprop)
    		{
				if ('latitude' == $subprop->getAttribute('tourml:name'))
					$geolocation->setLatitude($subprop->nodeValue);
				if ('longitude' == $subprop->getAttribute('tourml:name'))
					$geolocation->setLongitude($subprop->nodeValue);
    		}
    	}
    	$place->setGeolocation($geolocation);

    	$this->dm->persist($place);
	}

	private function persistResource(\DomElement $element)
	{
		$resource = new Resource();

		$nodes = $element->getElementsByTagName('Title');
		if ($nodes->length > 0)
			$resource->setTitle($nodes->item(0)->nodeValue);

		$nodes = $element->getElementsByTagName('AssetRef');
		if ($nodes->length == 1)
		{
			$asset = $this->getAsset($nodes->item(0)->getAttribute('tourml:id'));
			if ($asset)
			{
				$this->dm->persist($asset);
				$resource->addAssets($asset);
			}
		}

		$this->dm->persist($resource);
	}

	private function getLocalizedProperty(\DomElement $element, $tagName)
	{
		$localizedStrings = array();
		$nodes = $element->getElementsByTagName($tagName);
		foreach($nodes as $node)
		{
			$localizedString = new LocalizedString();
			$localizedString->setLanguage($node->getAttribute('xml:lang'));
			$localizedString->setValue(trim($node->nodeValue));
			$localizedStrings[] = $localizedString;
		}
		return $localizedStrings;
	}

	private function getAsset($id)
	{
		$xpath = new \DOMXPath($this->document);
		$entries = $xpath->query("/tourml:Tour/tourml:Asset[@tourml:id='$id']");
		if ($entries->length == 1)
		{
			$nodes = $entries->item(0)->getElementsByTagName('Source');
			if ($nodes->length == 1)
			{
				$node = $nodes->item(0);
				$uri_parts = parse_url($node->getAttribute('tourml:uri'));
				$asset_path = realpath($this->directory . $uri_parts['path']);

				$asset = new Asset();
				$asset->setLanguage($node->getAttribute('xml:lang'));
				$asset->setFormat($node->getAttribute('tourml:format'));
				if (file_exists($asset_path))
					$asset->setFile($asset_path);

				return $asset;
			}
		}
		return null;
	}

}

?>
