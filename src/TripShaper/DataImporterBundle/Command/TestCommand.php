<?php

namespace TripShaper\DataImporterBundle\Command;

use TripShaper\DataImporterBundle\SearchEngine\SearchService;
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
            ->setName('tripshaper:load')
            ->setDescription('Load test data into Elastic Search')
            ->addArgument('records_count', InputArgument::OPTIONAL, 'How many records to generate ?')
        ;
    }

    private function generateTags($minTag, $maxTags, $proposedTags)
    {
        // Some validations before starting
        if(count($proposedTags) < $maxTags)
            throw new Exception("maxTags should be lower than proposed tags list size");
        if($minTag < 0)
            throw new Exception("minTag should be positive");

        $tags = array();
        $tagNumber = rand($minTag, $maxTags);
        $notUsedTags = $proposedTags;
        for ($i = 0 ; $i < $tagNumber ; $i++)
        {
            shuffle($notUsedTags);
            $tags += array_fill(0,max(1, rand(-2,3)), array_pop($notUsedTags));
        }
        return $tags;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $records_count = $input->getArgument('records_count');
        if (!$records_count)
            $records_count = 1000;

        $service = new SearchService();
        $index = $service->getIndex("ileyeu");
        // delete and create the index
        $index->create(array(), true);
        
        // getType will create if one does not exist
        $type = $index->getType('place');
        
        // special mapping for "cat" field
        $mapping = new \Elastica_Type_Mapping($type, array(
            'cat' => array ('type' => 'string', 'analyzer' => 'keyword' )
        )); 
        $type->setMapping($mapping);
        
        // tags lists for the generator
        $accessibility_tags = array('disabled', 'blind');
        $profil_tags = array('cspplus', 'sportif', 'couple_enfant', 'couple_adolescent');
        $interest_tags = array("architecture", "nature", "son_et_lumiere");

        // cats and subcat lists for the generator
        $cats = array(
          "phare et legendes" => array("phare", "legende"),
          "histoire" => array("pre-histoire", "contemporain", "revolution française"),
          );
        
        // bounding box for position generator
        $min_lat = 47.201843;
        $max_lat = 47.251737;
        
        $max_lon = -1.460495;
        $min_lon = -1.638336; 
        
        $docs = array();
        for($i = 0 ; $i  < $records_count ; $i++)
        {
            $cat = array_keys($cats);
            $cat = $cat[rand(0, count($cat)-1)];
            $subcat = $cats[$cat][rand(0,count($cats[$cat])-1)];

            $lon = $min_lon + ($max_lon-$min_lon) * (mt_rand() / mt_getrandmax());
            $lat = $min_lat + ($max_lat-$min_lat) * (mt_rand() / mt_getrandmax());

            $docs[] = new \Elastica_Document($i, 
            array(
              "title" => "test",
              "short_description" => "Un simple test",
              "image" => "URL",
              
              /*"external_data" => array(
                "title" => "une autre titre",
                "best_hours" => "polynome qui approxime l'intérêt en fonction de l'heure de la journée et la journée de l'année 1 WE, ...",
                "another_idea" => "stats à la mode awstats",
              ),*/
              
              "cat" => $cat,
              "subcat" => $subcat,
              
              "tags" => array(
                "accessibility" => $this->generateTags(0,1, $accessibility_tags),
                "profile" => $this->generateTags(1,3, $profil_tags), 
                "interest" => $this->generateTags(1,2, $interest_tags),
              ),
              
              "price_from" => 0,
              "price_to" => 10,
              
                // this element is geo-enabled since it has lat and lon properties
              "location" => array(
                "lat" => $lat,
                "lon" => $lon,
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
        
        /*$facet = new \Elastica_Facet_Terms('cat');
        $facet->setField('cat');
        $query = new \Elastica_Query();
        $query->addFacet($facet);
        $query->setQuery(new \Elastica_Query_MatchAll());
        $response = $type->search($query);
        $facets = $response->getFacets();
        $output->writeln(var_export($facets));

        $facet = new \Elastica_Facet_Terms('tags');
        $facet->setField('tags.accessibility');
        $query = new \Elastica_Query();
        $query->addFacet($facet);
        $query->setQuery(new \Elastica_Query_MatchAll());
        $response = $type->search($query);
        $facets = $response->getFacets();
        $facet = new \Elastica_Facet_Terms('tags');
        $facet->setField('tags.accessibility');
        $query = new \Elastica_Query();
        $query->addFacet($facet);
        $query->setQuery(new \Elastica_Query_MatchAll());
        $response = $type->search($query);
        $facets = $response->getFacets();
        $output->writeln(var_export($facets));*/
        
        $resultSet = $index->search("tags.accessibility:disabled", 2);
        $output->writeln(var_export($resultSet, true));
    }
}

?>
