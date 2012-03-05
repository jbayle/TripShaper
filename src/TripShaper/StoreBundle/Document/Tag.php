<?php

namespace TripShaper\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Tag
{
	/**
	 * @MongoDB\Id
	 */
	private $id;

	/**
	 * @MongoDB\String
	 * @MongoDB\UniqueIndex()
	 */
	private $term;

	// ------------------------- METHODS ------------------------------ //

	/**
	 * __toString
	 *
	 * @return string $term
	 */
	public function __toString()
	{
		return $this->term;
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
     * Set term
     *
     * @param string $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * Get term
     *
     * @return string $term
     */
    public function getTerm()
    {
        return $this->term;
    }
}
