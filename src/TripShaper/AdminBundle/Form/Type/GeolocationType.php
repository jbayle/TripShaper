<?php

namespace TripShaper\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GeolocationType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('latitude', 'text')
			->add('longitude', 'text');
	}

	public function getDefaultOptions(array $options)
	{
		return array('data_class' => 'TripShaper\StoreBundle\Document\Geolocation');
	}

	public function getName()
	{
		return 'geolocation';
	}
}