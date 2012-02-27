<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="places")
 */
class Place
{
	/**
	 * @MongoDB\Id
	 */
	private $id;

	/**
	 * @MongoDB\Boolean
	 */
	private $is_published;

	/**
	 * @MongoDB\Boolean
	 */
	private $is_connector;

	/**
	 * @MongoDB\String
	 */
	private $title;

	/**
	 * @MongoDB\String
	 */
	private $shortDescription;

	/**
	 * @MongoDB\String
	 */
	private $localDescription;

	/**
	 * @MongoDB\String
	 */
	private $marketingDescription;

	/**
	 * @MongoDB\String
	 */
	private $type;

	/**
	 * @MongoDB\String
	 */
	private $subtype;

	/**
	 * @MongoDB\String
	 */
	private $author;

	/**
	 * @MongoDB\EmbedOne(targetDocument="Geolocation")
	 */
	private $location;

	/**
	 * @MongoDB\Float
	 */
	private $elevation;

	/**
	 * @MongoDB\Int
	 */
	private $level;

	/**
	 * @MongoDB\File
	 */
	//private $icon;

	/**
	 * @MongoDB\File
	 */
	//private $thumbnail;

	/**
	 * @MongoDB\EmbedMany(targetDocument="Geolocation")
	 */
	private $activationZone = array();

	/**
	 * @MongoDB\EmbedMany(targetDocument="Geolocation")
	 */
	private $atmosphereZone = array();

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
	 * Set is_published
	 *
	 * @param boolean $isPublished
	 */
	public function setIsPublished($isPublished)
	{
		$this->is_published = $isPublished;
	}

	/**
	 * Get is_published
	 *
	 * @return boolean $isPublished
	 */
	public function getIsPublished()
	{
		return $this->is_published;
	}

	/**
	 * Set is_connector
	 *
	 * @param boolean $isConnector
	 */
	public function setIsConnector($isConnector)
	{
		$this->is_connector = $isConnector;
	}

	/**
	 * Get is_connector
	 *
	 * @return boolean $isConnector
	 */
	public function getIsConnector()
	{
		return $this->is_connector;
	}

	/**
	 * Set latitude
	 *
	 * @param string $latitude
	 */
	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	}

	/**
	 * Get latitude
	 *
	 * @return string $latitude
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 * Set longitude
	 *
	 * @param string $longitude
	 */
	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
	}

	/**
	 * Get longitude
	 *
	 * @return string $longitude
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}

	/**
	 * Set elevation
	 *
	 * @param string $elevation
	 */
	public function setElevation($elevation)
	{
		$this->elevation = $elevation;
	}

	/**
	 * Get elevation
	 *
	 * @return string $elevation
	 */
	public function getElevation()
	{
		return $this->elevation;
	}

	/**
	 * Set level
	 *
	 * @param string $level
	 */
	public function setLevel($level)
	{
		$this->level = $level;
	}

	/**
	 * Get level
	 *
	 * @return string $level
	 */
	public function getLevel()
	{
		return $this->level;
	}
	public function __construct()
	{
		$this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * Set location
	 *
	 * @param TripShaper\StoreBundle\Document\Geolocation $location
	 */
	public function setLocation(\TripShaper\StoreBundle\Document\Geolocation $location)
	{
		$this->location = $location;
	}

	/**
	 * Get location
	 *
	 * @return TripShaper\StoreBundle\Document\Geolocation $location
	 */
	public function getLocation()
	{
		return $this->location;
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
	 * Set representationIcon
	 *
	 * @param file $representationIcon
	 */
	public function setRepresentationIcon($representationIcon)
	{
		$this->representationIcon = $representationIcon;
	}

	/**
	 * Get representationIcon
	 *
	 * @return file $representationIcon
	 */
	public function getRepresentationIcon()
	{
		return $this->representationIcon;
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
	 * Set icon
	 *
	 * @param file $icon
	 */
	public function setIcon($icon)
	{
		$this->icon = $icon;
	}

	/**
	 * Get icon
	 *
	 * @return file $icon
	 */
	public function getIcon()
	{
		return $this->icon;
	}

	/**
	 * Set thumbnail
	 *
	 * @param file $thumbnail
	 */
	public function setThumbnail($thumbnail)
	{
		$this->thumbnail = $thumbnail;
	}

	/**
	 * Get thumbnail
	 *
	 * @return file $thumbnail
	 */
	public function getThumbnail()
	{
		return $this->thumbnail;
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
}
