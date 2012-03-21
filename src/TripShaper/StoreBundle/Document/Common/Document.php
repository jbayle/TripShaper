<?php

namespace TripShaper\StoreBundle\Document\Common;

/**
 */
class Document
{

	/**
	 * Get default title
	 */
	public function getDefaultTitle()
	{
		if ($this->getTitles()->count() == 0) return null;
		return  $this->getTitles()->get(0)->getValue();
	}

	/**
	 * Set titles
	 *
	 * @param array $titles
	 */
	public function setTitles(array $titles = array())
	{
		$this->titles = new \Doctrine\Common\Collections\ArrayCollection($titles);
	}

}