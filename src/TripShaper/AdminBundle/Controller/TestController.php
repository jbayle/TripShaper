<?php

namespace TripShaper\AdminBundle\Controller;

use TripShaper\AdminBundle\Form\Model\Registration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TripShaper\StoreBundle\Document\Resource;
use TripShaper\StoreBundle\Document\Tag;
use TripShaper\StoreBundle\Document\Place;
use TripShaper\AdminBundle\Form\Type\PlaceType;

use TripShaper\StoreBundle\Document\Location;
use TripShaper\AdminBundle\Form\Type\LocationType;
use TripShaper\AdminBundle\Form\Type\RegistrationType;

class TestController extends Controller {
	/**
	 * @Route("/tmp/test1/", name="tmp_test1")
	 * @Template
	 */
	public function test1Action(Request $request)
	{
		$place = new Place();

		$form = $this->createForm(new LocationType(), new Location());

		if ($request->getMethod() == 'POST') {

			var_dump($form->getData());

			$form->bindRequest($request);
/*
			if ($form->isValid()) {
				$em = $this->get('doctrine.odm.mongodb.document_manager');
				$em->persist($place);
				$em->flush();
			}*/
		}

		return $this->render('TripShaperAdminBundle:Test:test.html.twig', array(
				'form' => $form->createView(),
		));

	}

	/**
	 * @Route("/tmp/test/", name="tmp_test")
	 * @Template
	 */
	public function testAction()
	{
		$form = $this->createForm(new RegistrationType(), new Registration());

		if ($this->getRequest()->getMethod() == 'POST') {

			$form->bindRequest($this->getRequest());

			if ($form->isValid()) {
				$dm = $this->get('doctrine.odm.mongodb.document_manager');
				$registration = $form->getData();
		        $dm->persist($registration->getUser());
		        $dm->flush();
			}
		}

		return $this->render('TripShaperAdminBundle:Test:test.html.twig', array(
				'form' => $form->createView(),
		));

	}

}