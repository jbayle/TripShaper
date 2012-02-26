<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="maps")
 */
class Map
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $title;

	/**
	 * @MongoDB\File
	 */
    //private $basemap;

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
     * Set basemap
     *
     * @param file $basemap
     */
    public function setBasemap($basemap)
    {
        $this->basemap = $basemap;
    }

    /**
     * Get basemap
     *
     * @return file $basemap
     */
    public function getBasemap()
    {
        return $this->basemap;
    }
}
