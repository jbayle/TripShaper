<?php

namespace TripShaper\DataImporterBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tripshaper:test')
            ->setDescription('Load test data into Elastic Search')
            ->addArgument('records_count', InputArgument::OPTIONAL, 'How many records to generate ?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $records_count = $input->getArgument('records_count');
        if ($records_count) {
            $text = 'Hello '.$records_count;
        } else {
            $text = 'Hello';
        }
        
        $config = array(
            'host' => 'localhost',
            'port' => '9200',
            'transport' => 'http',
        );
        
        $client = new \Elastica_Client($config);
        $index = $client->getIndex("ileyeu");
        //$index->delete();
        
        //getType will create if one does not exist
        $type = $index->getType('places');
        
        $cats = array(
          "copinage"=> array("laura", "marie", "alice"),
          "joli_coeur" => array("cloney", "dujardin", "pit"),
          "another cat" => array("c'est si beau", "loin de toi", "comme moi"),
          );
        //Add a document with an id of 1
        // 8 secondes pour 10000 documents
        $docs = array();
        for($i = 0 ; $i  < 10000 ; $i++)
        {
        $cat = array_keys($cats);
        $cat = $cat[rand(0, count($cat)-1)];
        $subcat = $cats[$cat][rand(0,2)];
        
        $docs[] = new \Elastica_Document($i, 
            array(
              "title2" => "test",
              "short_description" => "Un simple test",
              "image" => "URL",
              
              "external_data" => array(
                "title" => "une autre titre",
                "description" => "une autre description"
              ),
            
              "statistics" => array(
                "age_function" => "polynome qui approxime l'intéret en fonction de l'âge",
                "month_function" => "polynome qui approxime l'intéret en fonction du mois de l'année",
                "weather_function" => "polynome qui approxime l'intéret en fonction du mois de la meteo suivant le vent, l'état du ciel, la pluie",
                "best_hours" => "polynome qui approxime l'intérêt en fonction de l'heure de la journée et la journée de l'année 1 WE, ...",
                "another_idea" => "stats à la mode awstats",
              ),
              
              "cat" => $cat,
              //"subcat" => $subcat,
              
              "tags" => array(
                "accessibility" => array("disabled", "blind", ($i == 80 ? "toto2" : "testautre"), ($i == 90 ? "toto3" : "testautre") ),
                "profile" => array("cspplus", "couple_jeune", "couple_avec_enfants"),
                "interest" => array("architecture", "nature", "son_et_lumiere"),
                "style" => array("free, romantics, ...")
              ),
              // accepter le social tagguing (workflow par ailleur)
              
              "price_from" => 0,
              "price_to" => 10,
              
              "location" => array(
                "lat" => "47.174778",
                "lon" => "-1.230469",
                "adress" => "la campagne",
                "city" => "vallet",
                "postcode" => "44330"
              ),
              
              "best_next_location_ids" => array(),
              
              "open_hours" => "version texte / version numérique",
              
              "autor" => "julien".$i." baye",    
              "date" => "2009-11-15T14:12:12",
              "status" => "published",
              "lang" => "FR", /*(une fiche contenu par langue mais metadonnées en commun : comment faire ?) */
              /*
              "comments" => (only last valid comments, other are in other DB)
                "count"
                "comments"
                  "name"
                  "profile"
                    "groupe amis"
                    "couples jeunes"
                    "couples ages mur"
                    "famille avec enfants"
                    "famille avec adolescent"
                    "voyageur seul" 
                  "origin" : country and city  (liste des villes et pays à récupérer)
                  "date"
                  "global_score"
                  "score par aspect" : (aspects à étudier : intérêt / receommande / ...)
                  "score_usefull"
                  "score_useless"
                  "text_positive"
                  "text_negative"
              
              
      
              "score" => (history in other BD)
                "global"
                   */
        ));
        
        // MongoDB document for persistance
        // Requests and discution (forum)
        /*new \Elastica_Document(array(
          from
          description
          date
          comments (
            "comment :
              date
              autor
              comments
          )
        
        ));  */
        
        
        }
        $type->addDocuments($docs);
        
        $index->refresh(); 
        
        $resultSet = $index->search("profile:cspplus +tags.accessibility:toto3");
        
        echo var_export($resultSet, true);
        
        $output->writeln($text);
    }
}

?>