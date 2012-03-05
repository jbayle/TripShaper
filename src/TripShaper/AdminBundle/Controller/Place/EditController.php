<?php

namespace TripShaper\AdminBundle\Controller\Place;

use Admingenerated\TripShaperAdminBundle\BasePlaceController\EditController as BaseEditController;
use TripShaper\StoreBundle\Document\Tag;

class EditController extends BaseEditController
{
	public function preSave(\Symfony\Component\Form\Form $form, \TripShaper\StoreBundle\Document\Place $Place)
	{

		$Place->getTags()->clear();

		// FIXME if no entities is set, the update fails
		$tag = new Tag();
		$tag->setTerm("fixme");
		$Place->addTags($tag);

		if ($form['group']->getData())
		{
			$formTags = explode(',', $form['group']->getData());
			foreach ($formTags as $formTag)
			{
				$tag = new Tag();
				$tag->setTerm($formTag);
				$Place->addTags($tag);
			}
		}

	}
}
