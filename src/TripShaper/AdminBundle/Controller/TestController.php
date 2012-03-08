<?php

namespace TripShaper\AdminBundle\Controller;

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

class TestController extends Controller {
	/**
	 * @Route("/tmp/test/", name="tmp_test")
	 * @Template
	 */
	public function testAction(Request $request)
	{
		$place = new Place();

		$form = $this->createForm(new PlaceType(), $place);

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->get('doctrine.odm.mongodb.document_manager');
				$em->persist($place);
				$em->flush();
			}
		}

		return $this->render('TripShaperAdminBundle:Test:test.html.twig', array(
				'form' => $form->createView(),
		));

	}

}