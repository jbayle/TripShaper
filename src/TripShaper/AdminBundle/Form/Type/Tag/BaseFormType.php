<?php

namespace TripShaper\AdminBundle\Form\Type\Tag;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use TripShaper\AdminBundle\Form\DataTransformer\TagsTransformer;

class BaseFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
	}

	public function getParent(array $options)
	{
		return 'hidden';
	}

	public function getName()
	{
		return 'tags';
	}
}