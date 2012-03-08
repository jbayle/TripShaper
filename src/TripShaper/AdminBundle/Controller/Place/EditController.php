<?php

namespace TripShaper\AdminBundle\Controller\Place;

use Admingenerated\TripShaperAdminBundle\BasePlaceController\EditController as BaseEditController;
use TripShaper\StoreBundle\Document\Tag;
use TripShaper\StoreBundle\Document\LocalizedString;

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

	protected function saveObject(\TripShaper\StoreBundle\Document\Place $Place)
	{
		$dm = $this->getDocumentManager();
		$dm->persist($Place);
		foreach($Place->getTags() as $tag)
		{
			$dm->persist($tag);
		}
		foreach($Place->getTitles() as $title)
		{
			$dm->persist($title);
		}
		$dm->flush();
	}
}
