<?php

namespace TripShaper\StoreBundle\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Comment
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
	 * @MongoDB\EmbedOne(targetDocument="LocalizedString")
	 */
	private $description;

	/**
	 * @MongoDB\Boolean
	 */
	private $isPublic;

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
     * Set isPublic
     *
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    }

    /**
     * Get isPublic
     *
     * @return boolean $isPublic
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }
}
