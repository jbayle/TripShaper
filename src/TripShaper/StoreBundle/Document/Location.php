<?php

namespace TripShaper\StoreBundle\Document;

use Symfony\Component\Validator\Constraints as Assert;

use TripShaper\StoreBundle\Document\Geolocation;

class Location
{
	/**
	 * @Assert\Type(type="TripShaper\StoreBundle\Document\Geolocation")
	 */
	protected $geolocation;

	/**
	 * @Assert\NotBlank()
	 * @Assert\True()
	 */
	protected $termsAccepted;

	public function setGeolocation(Geolocation $geolocation)
	{
		$this->geolocation = $geolocation;
	}

	public function getGeolocation()
	{
		return $this->geolocation;
	}

	public function getTermsAccepted()
	{
		return $this->termsAccepted;
	}

	public function setTermsAccepted($termsAccepted)
	{
		$this->termsAccepted = (boolean)$termsAccepted;
	}
}