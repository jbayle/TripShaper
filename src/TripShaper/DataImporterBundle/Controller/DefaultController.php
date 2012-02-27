<?php

namespace TripShaper\DataImporterBundle\Controller;

use TripShaper\DataImporterBundle\SearchEngine\SearchService;
use TripShaper\DataImporterBundle\KmlCreator\KML;
use TripShaper\DataImporterBundle\KmlCreator\KMLDocument;
use TripShaper\DataImporterBundle\KmlCreator\KMLStyle;
use TripShaper\DataImporterBundle\KmlCreator\KMLPoint;
use TripShaper\DataImporterBundle\KmlCreator\KMLFolder;
use TripShaper\DataImporterBundle\KmlCreator\KMLPlaceMark;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/test/{query}")
     * @Template()
     */
    public function indexAction($query)
    {
	    $service = new SearchService();
        $index = $service->getIndex("ileyeu");
	    $resultSet = $index->search($query);

	    return array("result" => var_export($resultSet->getResponse()));
    }

    /**
      * @Route("/kml")
      * @Template()
      */
    public function kmlAction()
    {
        $kml = new KML();
        $document = new KMLDocument('sample', 'sample');
        $style = new KMLStyle('placeStyle');
        $style->setIconStyle('images/fish.png', 'ffffffff', 'normal', 1);
        $style->setLineStyle('ffffffff', 'normal', 2);
        $document->addStyle($style);
        $kml->addFile('http://www.graphics-and-desktop-icons.com/image-files/fish-icon-64.jpg', 'images/fish.png'); 
        
        $placeFolder = new KMLFolder('', 'PLACES');

        $service = new SearchService();
        $index = $service->getIndex("ileyeu");
        
        $query = new \Elastica_Query();
        $query->setLimit(1000);
        $query->setQuery(new \Elastica_Query_MatchAll());
        $all_docs = $index->search($query);
        foreach($all_docs as $doc)
        {
            $place = new KMLPlaceMark('', $doc->title, $doc->desc, true);
            $place->setGeometry(new KMLPoint($doc->location['lon'], $doc->location['lat'], 0));
            $place->setStyleUrl('#placeStyle');
            $placeFolder->addFeature($place);            
        }
        $document->addFeature($placeFolder);
        $kml->setFeature($document);
        
        $response = new Response($kml->output('S'));
        $response->headers->set('Content-Type', 'application/vnd.google-earth.kml+xml'); 
        return $response;        
    }
}
