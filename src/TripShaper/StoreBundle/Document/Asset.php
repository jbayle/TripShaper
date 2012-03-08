<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="assets")
 */
class Asset
{
	/**
	 * @MongoDB\Id
	 */
	private $id;

	/**
	 * @MongoDB\String
	 */
	private $language;

	/**
	 * @MongoDB\String
	 */
	private $format;

	/**
	 * @MongoDB\File
	 */
	private $file;

	// ------------------------- METHODS ------------------------------ //

	public function __toString()
	{
		return $this->getLanguage();
	}

	// ----------------------- GENERATED ---------------------------- //


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
     * Set language
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return string $language
     */
    public function getLanguage()
    {
        return $this->language;
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
     * Set file
     *
     * @param file $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * Get file
     *
     * @return file $file
     */
    public function getFile()
    {
        return $this->file;
    }
}
