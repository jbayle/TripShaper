<?php

namespace TripShaper\DataImporterBundle\SearchEngine;

class SearchService {
    
    private $client;

    public function __construct()
    {
        $config = array(
            'host' => '127.0.0.1',
            'port' => '9200',
        );
 
        $this->client = new \Elastica_Client($config);
    }

    public function getIndex($name)
    {
        return $this->client->getIndex($name);
    }

}
