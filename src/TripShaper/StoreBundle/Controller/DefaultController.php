<?php

namespace TripShaper\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TripShaper\StoreBundle\Document\Resource;
use Symfony\Component\HttpFoundation\Response;

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

	    $dm = $this->get('doctrine.odm.mongodb.document_manager');
	    $dm->persist($resource);
	    $dm->flush();

	    return new Response('Created resource id '.$resource->getId());
	}
}
