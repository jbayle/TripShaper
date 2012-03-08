<?php

namespace TripShaper\AdminBundle\Form\Type\Place;

use Admingenerated\TripShaperAdminBundle\Form\BasePlaceType\NewType as BaseNewType;
use Symfony\Component\Form\FormBuilder;
use TripShaper\AdminBundle\Form\Type\LocalizedStringType;
use TripShaper\AdminBundle\Form\Type\GeolocationType;

class NewType extends BaseNewType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		parent::buildForm($builder, $options);

		$builder->remove('titles');

		$builder->add( 'titles', 'collection', array(
			'type' => new LocalizedStringType(),
			'allow_add' => true,
			'allow_delete' => true,
			'prototype' => true,
		));

		$builder->remove('geolocation');
		$builder->add( 'geolocation', new GeolocationType());

	}

	public function getDefaultOptions(array $options)
	{
		return array(
				'data_class' => 'TripShaper\StoreBundle\Document\Place',
		);
	}
}
