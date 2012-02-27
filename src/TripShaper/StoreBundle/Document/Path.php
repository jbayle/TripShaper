<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="paths")
 */
class Path
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
	 * @MongoDB\ReferenceOne(
	 *     targetDocument="Place"
	 * )
	 */
	private $departure;

	/**
	 * @MongoDB\ReferenceOne(
	 *     targetDocument="Place"
	 * )
	 */
	private $arrival;

	/**
	 * @MongoDB\EmbedMany(targetDocument="Tag")
	 */
	private $tags = array();

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
	 * Set place
	 *
	 * @param Document\Place $place
	 */
	public function setPlace(\Document\Place $place)
	{
		$this->place = $place;
	}

	/**
	 * Get place
	 *
	 * @return Document\Place $place
	 */
	public function getPlace()
	{
		return $this->place;
	}
	public function __construct()
	{
		$this->place = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add place
	 *
	 * @param Document\Place $place
	 */
	public function addPlace(\Document\Place $place)
	{
		$this->place[] = $place;
	}

    /**
     * Set placeDeparture
     *
     * @param TripShaper\StoreBundle\Document\Place $placeDeparture
     */
    public function setPlaceDeparture(\TripShaper\StoreBundle\Document\Place $placeDeparture)
    {
        $this->placeDeparture = $placeDeparture;
    }

    /**
     * Get placeDeparture
     *
     * @return TripShaper\StoreBundle\Document\Place $placeDeparture
     */
    public function getPlaceDeparture()
    {
        return $this->placeDeparture;
    }

    /**
     * Set placeArrival
     *
     * @param TripShaper\StoreBundle\Document\Place $placeArrival
     */
    public function setPlaceArrival(\TripShaper\StoreBundle\Document\Place $placeArrival)
    {
        $this->placeArrival = $placeArrival;
    }

    /**
     * Get placeArrival
     *
     * @return TripShaper\StoreBundle\Document\Place $placeArrival
     */
    public function getPlaceArrival()
    {
        return $this->placeArrival;
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
     * Set departure
     *
     * @param TripShaper\StoreBundle\Document\Place $departure
     */
    public function setDeparture(\TripShaper\StoreBundle\Document\Place $departure)
    {
        $this->departure = $departure;
    }

    /**
     * Get departure
     *
     * @return TripShaper\StoreBundle\Document\Place $departure
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set arrival
     *
     * @param TripShaper\StoreBundle\Document\Place $arrival
     */
    public function setArrival(\TripShaper\StoreBundle\Document\Place $arrival)
    {
        $this->arrival = $arrival;
    }

    /**
     * Get arrival
     *
     * @return TripShaper\StoreBundle\Document\Place $arrival
     */
    public function getArrival()
    {
        return $this->arrival;
    }
}
