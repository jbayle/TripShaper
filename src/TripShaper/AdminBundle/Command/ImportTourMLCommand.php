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

	    if (count($this->document->getElementsByTagName('Tour')) != 1) throw new \Exception('A TourML file must contain a single tour object');

	    $path_parts = pathinfo(realpath($file));
	    $this->directory = $path_parts['dirname'];

	    $this->dm = $this->getContainer()->get('doctrine.odm.mongodb.document_manager');

	    // TODO : Remove this lines when the import gains stability
		$this->dm->createQueryBuilder('TripShaperStoreBundle:Trip')->remove()->getQuery()->execute();
		$this->dm->createQueryBuilder('TripShaperStoreBundle:Place')->remove()->getQuery()->execute();
		$this->dm->createQueryBuilder('TripShaperStoreBundle:Resource')->remove()->getQuery()->execute();
		$this->dm->createQueryBuilder('TripShaperStoreBundle:Asset')->remove()->getQuery()->execute();

		// Trip / Tour
		$trip = new Trip();
		$trip->setTitles($this->getLocalizedProperty("/tourml:Tour/tourml:Title"));

		// Places
		$xpath = new \DOMXPath($this->document);
		$entries = $xpath->query("/tourml:Tour/tourml:Stop[@tourml:view='StopGroup']");
		foreach($entries as $entry) {
			$trip->addPlaces($this->persistPlace($entry));
		}
	    $this->dm->flush();

	    // Add each Place's Resource as Trip's global Resource
		$places = $this->dm->createQueryBuilder('TripShaperStoreBundle:Place')->find()->getQuery()->execute();
		foreach ($places as $place) {
			$resources = $place->getResources();
			foreach ($resources as $resource) {
				$trip->addResources($resource);
			}
		}

		$this->dm->persist($trip);
		$this->dm->flush();
    }

    /**
     * Persist a Place in the Document Manager
     * @param element DOM Element
     * @return Place object
     */
	private function persistPlace(\DomElement $element)
	{
		$place = new Place();
    	$place->setTitles($this->getLocalizedProperty("/tourml:Tour/tourml:Stop[@tourml:id='{$element->getAttribute('tourml:id')}']/tourml:Title"));

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

    	// Resources
    	$nodes = $element->getElementsByTagName('StopRef');
    	foreach ($nodes as $node) {
    		$xpath = new \DOMXPath($this->document);
			$entries = $xpath->query("/tourml:Tour/tourml:Stop[@tourml:id='{$node->getAttribute('tourml:id')}']");
			if ($entries->length == 1)
			{
				$place->addResources($this->persistResource($entries->item(0)));
			}
    	}

    	$this->dm->persist($place);
    	return $place;
	}

	/**
	 * Persist a Resource in the Document Manager
	 * @param element DOM Element
	 * @return Resource object
	 */
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
		return $resource;
	}

	/**
	 * Find all the localized nodes for the required property
	 * @param query XPath query to find the nodes
	 * @return array of LocalizedString object
	 */
	private function getLocalizedProperty($query)
	{
		$localizedStrings = array();
		$xpath = new \DOMXPath($this->document);
		$entries = $xpath->query($query);
		foreach($entries as $entry)
		{
			$localizedString = new LocalizedString();
			$localizedString->setLanguage($entry->getAttribute('xml:lang'));
			$localizedString->setValue(trim($entry->nodeValue));
			$localizedStrings[] = $localizedString;
		}
		return $localizedStrings;
	}

	/**
	 * Find asset by id
	 * @param id Unique id of the asset to find
	 * @return Asset object
	 */
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
