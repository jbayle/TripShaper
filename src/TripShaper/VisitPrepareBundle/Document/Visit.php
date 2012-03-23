<?php

namespace TripShaper\VisitPrepareBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="visits")
 */
class Visit
{
    /**
     * @MongoDB\Id
     */
    private $id;

	/**
	 * @MongoDB\String
	 */
    private $name;
	  
	/**
	 * @MongoDB\EmbedMany(targetDocument="Trip")
	 */  
    private $tour_list;

	/**
	 * @MongoDB\String
	 */
    private $css;
	
	/**
	 * @MongoDB\String
	 */
    private $logo;
    
    public function __construct()
    {
        $this->tour_list = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add tour_list
     *
     * @param TripShaper\VisitPrepareBundle\Document\Trip $tourList
     */
    public function addTourList(\TripShaper\VisitPrepareBundle\Document\Trip $tourList)
    {
        $this->tour_list[] = $tourList;
    }

    /**
     * Get tour_list
     *
     * @return Doctrine\Common\Collections\Collection $tourList
     */
    public function getTourList()
    {
        return $this->tour_list;
    }

    /**
     * Set css
     *
     * @param string $css
     */
    public function setCss($css)
    {
        $this->css = $css;
    }

    /**
     * Get css
     *
     * @return string $css
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * Set logo
     *
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return string $logo
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
