<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="trips")
 */
class Trip extends Common\Document
{
	/**
	 * @MongoDB\Id
	 */
	protected $id;

	/**
	 * @MongoDB\EmbedMany(targetDocument="LocalizedString")
	 */
	protected $titles;

	/**
	 * @MongoDB\String
	 */
	protected $description;

	/**
	 * @MongoDB\File
	 */
	//protected $icon;

	/**
	 * @MongoDB\File
	 */
	//protected $splash;

	/**
	 * @MongoDB\Date
	 */
	protected $date;

	/**
	 * @MongoDB\EmbedMany(targetDocument="Comment")
	 */
	protected $comments = array();

	/**
	 * @MongoDB\ReferenceMany(targetDocument="Place")
	 */
	protected $places = array();

	/**
	 * @MongoDB\ReferenceMany(targetDocument="Resource")
	 */
	protected $resources = array();

	// ------------------------- METHODS ------------------------------ //

	// ----------------------- GENERATED ---------------------------- //

    public function __construct()
    {
        $this->titles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resources = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add titles
     *
     * @param TripShaper\StoreBundle\Document\LocalizedString $titles
     */
    public function addTitles(\TripShaper\StoreBundle\Document\LocalizedString $titles)
    {
        $this->titles[] = $titles;
    }

    /**
     * Get titles
     *
     * @return Doctrine\Common\Collections\Collection $titles
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add comments
     *
     * @param TripShaper\StoreBundle\Document\Comment $comments
     */
    public function addComments(\TripShaper\StoreBundle\Document\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection $comments
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add places
     *
     * @param TripShaper\StoreBundle\Document\Place $places
     */
    public function addPlaces(\TripShaper\StoreBundle\Document\Place $places)
    {
        $this->places[] = $places;
    }

    /**
     * Get places
     *
     * @return Doctrine\Common\Collections\Collection $places
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Add resources
     *
     * @param TripShaper\StoreBundle\Document\Resource $resources
     */
    public function addResources(\TripShaper\StoreBundle\Document\Resource $resources)
    {
        $this->resources[] = $resources;
    }

    /**
     * Get resources
     *
     * @return Doctrine\Common\Collections\Collection $resources
     */
    public function getResources()
    {
        return $this->resources;
    }
}
