<?php

namespace TripShaper\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use TripShaper\StoreBundle\Document\Trip;
use TripShaper\StoreBundle\Document\Place;
use TripShaper\StoreBundle\Document\LocalizedString;

class ImportTourMLCommand extends ContainerAwareCommand
{
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

	    $tourML = new \DOMDocument('1.0', 'UTF-8');
	    if (false === $tourML->load($file)) throw new \Exception('Error in XML');

	    $stops = $tourML->getElementsByTagName('Stop');
	    foreach($stops as $stop) {

	    	$place = new Place();
	    	//$place->setTitle($stop->getAttribute('tourml:id'))

	    	$props = $stop->getElementsByTagName('Title');
	    	foreach($props as $prop) {
	    		$localString = new LocalizedString();
	    		$localString->setLocale($prop->getAttribute('xml:lang'));
	    		$localString->setValue($prop->nodeValue);
				$place->addTitles($localString);

	    	}

	    	$dm = $this->getContainer()->get('doctrine.odm.mongodb.document_manager');
	    	$dm->persist($place);
	    	$dm->flush();

			//$output->writeln($title->item(0)->nodeValue);

	    }

    }
}

?>
