<?php

namespace TripShaper\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use TripShaper\StoreBundle\Document\Resource;
use TripShaper\StoreBundle\Document\Place;
use TripShaper\StoreBundle\Document\Tag;


class DefaultController extends Controller
{
	/**
	 * @Route("/hello/{name}")
	 * @Template()
	 */
	public function indexAction($name)
	{
		return array('name' => $name);
	}

	/**
	 * @Route("/store/create")
	 * @Template()
	 */
	public function createAction()
	{
		$resource = new Resource();
		$resource->setTitle('Resource ONE');

		$tag = new Tag();
		$tag->setTerm("culture");
		$resource->addTags($tag);

		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$dm->persist($resource);
		$dm->flush();

		return new Response('Created resource id '.$resource->getId());
	}

	/**
	 * @Route("/store/create/place")
	 * @Template()
	 */
	public function createPlaceAction()
	{
		$place = new Place();
		$place->setTitle('Place TEST');
/*
		$tag = new Tag();
		$tag->setTerm("test1");
		$place->addTags($tag);

		$tag = new Tag();
		$tag->setTerm("test2");
		$place->addTags($tag);

		$tag = new Tag();
		$tag->setTerm("test3");
		$place->addTags($tag);
*/
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$dm->persist($place);
		$dm->flush();

		return new Response('Created place id '.$place->getId());
	}

	/**
	 * @Route("/store/show")
	 * @Template()
	 */
	public function showAction($id)
	{
		$resource = $this->get('doctrine.odm.mongodb.document_manager')
		->getRepository('TripShaperStoreBundle:Resource')
		->find($id);

		if (!$resource) {
			throw $this->createNotFoundException('No resource found for id '.$id);
		}

		return new Response($resource->getTags());
	}

	/**
	 * @Route("/store/update/place/{id}")
	 * @Template()
	 */
	public function updatePlaceAction($id)
	{
		$place = $this->get('doctrine.odm.mongodb.document_manager')
		->getRepository('TripShaperStoreBundle:Place')
		->find($id);

		if (!$place) {
			throw $this->createNotFoundException('No resource found for id '.$id);
		}

		$tag = new Tag();
		$tag->setTerm("new tag");
		$place->addTags($tag);

		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$dm->persist($place);
		$dm->flush();

		return new Response($place->getTags());
	}

	/**
	 * @Route("/store/showall")
	 * @Template()
	 */
	public function showAllAction($id)
	{
		$resource = $this->get('doctrine.odm.mongodb.document_manager')
		->getRepository('TripShaperStoreBundle:Tags')
		->find($id);

		if (!$resource) {
			throw $this->createNotFoundException('No resource found for id '.$id);
		}

		return new Response($resource->getTags());
	}
}
