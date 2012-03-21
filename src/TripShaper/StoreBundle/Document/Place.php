<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="places")
 */
class Place extends Common\Document
{
	/**
	 * @MongoDB\Id
	 */
	protected $id;

	/**
	 * @MongoDB\Boolean
	 */
	protected $isPublished;

	/**
	 * @MongoDB\Boolean
	 */
	protected $isConnector;

	/**
	 * @MongoDB\EmbedMany(targetDocument="LocalizedString")
	 */
	protected $titles = array();

	/**
	 * @MongoDB\String(nullable="true")
	 */
	protected $shortDescription;

	/**
	 * @MongoDB\String(nullable="true")
	 */
	protected $localDescription;

	/**
	 * @MongoDB\String(nullable="true")
	 */
	protected $marketingDescription;

	/**
	 * @MongoDB\String
	 */
	protected $type;

	/**
	 * @MongoDB\String
	 */
	protected $subtype;

	/**
	 * @MongoDB\String(nullable="true")
	 */
	protected $author;

	/**
	 * @MongoDB\EmbedOne(targetDocument="Geolocation", nullable="true")
	 */
	protected $geolocation;

	/**
	 * @MongoDB\Float(nullable="true")
	 */
	protected $elevation;

	/**
	 * @MongoDB\Int
	 */
	protected $level;

	/**
	 * @MongoDB\String
	 */
	protected $icon;

	/**
	 * @MongoDB\String
	 */
	protected $thumbnail;

	/**
	 * @MongoDB\EmbedMany(targetDocument="Geolocation")
	 */
	protected $activationZone = array();

	/**
	 * @MongoDB\EmbedMany(targetDocument="Geolocation")
	 */
	protected $atmosphereZone = array();

	/**
	 * @MongoDB\EmbedMany(targetDocument="Tag")
	 */
	protected $tags = array();

	/**
	 * @MongoDB\ReferenceMany(targetDocument="Resource")
	 */
	protected $resources = array();

	// ------------------------- METHODS ------------------------------ //

	// ----------------------- GENERATED ---------------------------- //

    public function __construct()
    {
        $this->titles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->activationZone = new \Doctrine\Common\Collections\ArrayCollection();
        $this->atmosphereZone = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resources = new \Doctrine\Common\Collections\ArrayCollection();

        $this->geolocation = new Geolocation();
        $this->titles[] = new LocalizedString();
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
     * Set isPublished
     *
     * @param boolean $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * Get isPublished
     *
     * @return boolean $isPublished
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set isConnector
     *
     * @param boolean $isConnector
     */
    public function setIsConnector($isConnector)
    {
        $this->isConnector = $isConnector;
    }

    /**
     * Get isConnector
     *
     * @return boolean $isConnector
     */
    public function getIsConnector()
    {
        return $this->isConnector;
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
     * Set shortDescription
     *
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * Get shortDescription
     *
     * @return string $shortDescription
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set localDescription
     *
     * @param string $localDescription
     */
    public function setLocalDescription($localDescription)
    {
        $this->localDescription = $localDescription;
    }

    /**
     * Get localDescription
     *
     * @return string $localDescription
     */
    public function getLocalDescription()
    {
        return $this->localDescription;
    }

    /**
     * Set marketingDescription
     *
     * @param string $marketingDescription
     */
    public function setMarketingDescription($marketingDescription)
    {
        $this->marketingDescription = $marketingDescription;
    }

    /**
     * Get marketingDescription
     *
     * @return string $marketingDescription
     */
    public function getMarketingDescription()
    {
        return $this->marketingDescription;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set subtype
     *
     * @param string $subtype
     */
    public function setSubtype($subtype)
    {
        $this->subtype = $subtype;
    }

    /**
     * Get subtype
     *
     * @return string $subtype
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return string $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set geolocation
     *
     * @param TripShaper\StoreBundle\Document\Geolocation $geolocation
     */
    public function setGeolocation(\TripShaper\StoreBundle\Document\Geolocation $geolocation)
    {
        $this->geolocation = $geolocation;
    }

    /**
     * Get geolocation
     *
     * @return TripShaper\StoreBundle\Document\Geolocation $geolocation
     */
    public function getGeolocation()
    {
        return $this->geolocation;
    }

    /**
     * Set elevation
     *
     * @param float $elevation
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;
    }

    /**
     * Get elevation
     *
     * @return float $elevation
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * Set level
     *
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Get level
     *
     * @return int $level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set icon
     *
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Get icon
     *
     * @return string $icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get thumbnail
     *
     * @return string $thumbnail
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Add activationZone
     *
     * @param TripShaper\StoreBundle\Document\Geolocation $activationZone
     */
    public function addActivationZone(\TripShaper\StoreBundle\Document\Geolocation $activationZone)
    {
        $this->activationZone[] = $activationZone;
    }

    /**
     * Get activationZone
     *
     * @return Doctrine\Common\Collections\Collection $activationZone
     */
    public function getActivationZone()
    {
        return $this->activationZone;
    }

    /**
     * Add atmosphereZone
     *
     * @param TripShaper\StoreBundle\Document\Geolocation $atmosphereZone
     */
    public function addAtmosphereZone(\TripShaper\StoreBundle\Document\Geolocation $atmosphereZone)
    {
        $this->atmosphereZone[] = $atmosphereZone;
    }

    /**
     * Get atmosphereZone
     *
     * @return Doctrine\Common\Collections\Collection $atmosphereZone
     */
    public function getAtmosphereZone()
    {
        return $this->atmosphereZone;
    }

    /**
     * Add tags
     *
     * @param TripShaper\StoreBundle\Document\Tag $tags
     */
    public function addTags(\TripShaper\StoreBundle\Document\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection $tags
     */
    public function getTags()
    {
        return $this->tags;
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
