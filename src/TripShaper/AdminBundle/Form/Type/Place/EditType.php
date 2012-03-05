<?php

namespace TripShaper\AdminBundle\Form\Type\Place;

use Admingenerated\TripShaperAdminBundle\Form\BasePlaceType\EditType as BaseEditType;
use Symfony\Component\Form\FormBuilder;
use TripShaper\AdminBundle\Form\Type\LocalizedStringType;

class EditType extends BaseEditType
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
			'by_reference' => false,
		));

		$builder->remove('tags');

		$group = '';
		foreach ($builder->getData()->getTags() as $tag) { $group .= $tag->getTerm() . ','; }

		$builder->add('group', 'hidden', array(
			'data' => $group,
			'property_path' => false,
			'required' => false
		));

	}
}
