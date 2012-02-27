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
	 * @MongoDB\EmbedOne(targetDocument="LocalizedString")
	 */
	private $title;

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
	 * Set splash
	 *
	 * @param file $splash
	 */
	public function setSplash($splash)
	{
		$this->splash = $splash;
	}

	/**
	 * Get splash
	 *
	 * @return file $splash
	 */
	public function getSplash()
	{
		return $this->splash;
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
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
}
