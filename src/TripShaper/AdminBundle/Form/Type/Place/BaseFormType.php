<?php

namespace TripShaper\AdminBundle\Form\Type\Place;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use JMS\SecurityExtraBundle\Security\Authorization\Expression\Expression;
use TripShaper\AdminBundle\Form\Type\LocalizedStringType;
use TripShaper\AdminBundle\Form\Type\GeolocationType;
use TripShaper\AdminBundle\Form\Type\Tag\BaseFormType as TagType;

class BaseFormType extends AbstractType
{
	protected $securityContext;

	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('shortDescription', 'textarea', array(  'required' => false,));
		$builder->add('localDescription', 'textarea', array(  'required' => false,));
		$builder->add('marketingDescription', 'textarea', array(  'required' => false,));

		$builder->add( 'titles', 'collection', array(
			'type' => new LocalizedStringType(),
			'allow_add' => true,
			'allow_delete' => true,
			'prototype' => true,
		));

		$builder->add('geolocation', new GeolocationType());

		$group = '';
		foreach ($builder->getData()->getTags() as $tag) { $group .= $tag->getTerm() . ','; }

		$builder->add('group', new TagType(), array(
				'data' => $group,
				'property_path' => false,
				'required' => false
		));

	}

	public function getName()
	{
		return 'form_place';
	}

	public function getDefaultOptions(array $options)
	{
		return array('data_class' => 'TripShaper\StoreBundle\Document\Place');
	}

	public function setSecurityContext($securityContext)
	{
		$this->securityContext = $securityContext;
	}
}
