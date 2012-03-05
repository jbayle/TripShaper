<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="trips")
 */
class Trip
{
	/**
	 * @MongoDB\Id
	 */
	private $id;

	/**
	 * @MongoDB\EmbedMany(targetDocument="LocalizedString")
	 */
	private $titles;

	/**
	 * @MongoDB\String
	 */
	private $description;

	/**
	 * @MongoDB\File
	 */
	//private $icon;

	/**
	 * @MongoDB\File
	 */
	//private $splash;

	/**
	 * @MongoDB\Date
	 */
	private $date;

	/**
	 * @MongoDB\EmbedMany(targetDocument="Comment")
	 */
	private $comments = array();

	// ----------------------- GENERATED ---------------------------- //

    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param TripShaper\StoreBundle\Document\LocalizedString $title
     */
    public function setTitle(\TripShaper\StoreBundle\Document\LocalizedString $title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return TripShaper\StoreBundle\Document\LocalizedString $title
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
}
