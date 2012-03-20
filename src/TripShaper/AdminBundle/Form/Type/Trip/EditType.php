<?php

namespace TripShaper\AdminBundle\Form\Type\Trip;

use Admingenerated\TripShaperAdminBundle\Form\BaseTripType\EditType as BaseEditType;
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
		));

	}
}
