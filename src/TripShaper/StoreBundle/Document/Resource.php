<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="resources")
 */
class Resource
{
	/**
	 * @MongoDB\Id
	 */
	private $id;

	/**
	 * @MongoDB\String
	 */
	private $title;

	/**
	 * @MongoDB\String
	 */
	private $description;

	/**
	 * @MongoDB\String
	 */
	private $format;

	/**
	 * @MongoDB\ReferenceMany(targetDocument="Asset")
	 */
	private $assets;

	/**
	 * @MongoDB\String
	 */
	private $dimension;

	/**
	 * @MongoDB\String
	 */
	private $duration;

	/**
	 * @MongoDB\Int
	 */
	private $order;

	/**
	 * @MongoDB\String
	 */
	private $playStrategy;

	/**
	 * @MongoDB\Int
	 */
	private $volume;

	/**
	 * @MongoDB\Boolean
	 */
	private $autoplay;

	/**
	 * @MongoDB\String
	 */
	private $copyrights;

	/**
	 * @MongoDB\ReferenceMany(targetDocument="Tag")
	 */
	private $tags = array();

	// ------------------------- METHODS ------------------------------ //

	// ----------------------- GENERATED ---------------------------- //

    public function __construct()
    {
        $this->assets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set format
     *
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Get format
     *
     * @return string $format
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Add assets
     *
     * @param TripShaper\StoreBundle\Document\Asset $assets
     */
    public function addAssets(\TripShaper\StoreBundle\Document\Asset $assets)
    {
        $this->assets[] = $assets;
    }

    /**
     * Get assets
     *
     * @return Doctrine\Common\Collections\Collection $assets
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Set dimension
     *
     * @param string $dimension
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }

    /**
     * Get dimension
     *
     * @return string $dimension
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Set duration
     *
     * @param string $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * Get duration
     *
     * @return string $duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set order
     *
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * Get order
     *
     * @return int $order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set playStrategy
     *
     * @param string $playStrategy
     */
    public function setPlayStrategy($playStrategy)
    {
        $this->playStrategy = $playStrategy;
    }

    /**
     * Get playStrategy
     *
     * @return string $playStrategy
     */
    public function getPlayStrategy()
    {
        return $this->playStrategy;
    }

    /**
     * Set volume
     *
     * @param int $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * Get volume
     *
     * @return int $volume
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set autoplay
     *
     * @param boolean $autoplay
     */
    public function setAutoplay($autoplay)
    {
        $this->autoplay = $autoplay;
    }

    /**
     * Get autoplay
     *
     * @return boolean $autoplay
     */
    public function getAutoplay()
    {
        return $this->autoplay;
    }

    /**
     * Set copyrights
     *
     * @param string $copyrights
     */
    public function setCopyrights($copyrights)
    {
        $this->copyrights = $copyrights;
    }

    /**
     * Get copyrights
     *
     * @return string $copyrights
     */
    public function getCopyrights()
    {
        return $this->copyrights;
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
}
