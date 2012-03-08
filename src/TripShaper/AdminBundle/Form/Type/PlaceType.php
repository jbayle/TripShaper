<?php

namespace TripShaper\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use TripShaper\AdminBundle\Form\Type\GeolocationType;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('title');

        $builder->add('geolocation', new GeolocationType());

    }

    public function getName()
    {
        return 'test_place';
    }

    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'TripShaper\StoreBundle\Document\Place',
    	);
    }

}

