<?php

namespace TripShaper\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LocalizedStringType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('language')
			->add('value');
	}

	public function getDefaultOptions(array $options)
	{
		return array('data_class' => 'TripShaper\StoreBundle\Document\LocalizedString');
	}

	public function getName()
	{
		return 'localized_string';
	}
}