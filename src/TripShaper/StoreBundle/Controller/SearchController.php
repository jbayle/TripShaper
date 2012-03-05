<?php

namespace TripShaper\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TripShaper\StoreBundle\Document\Resource;
use TripShaper\StoreBundle\Document\Tag;
use TripShaper\StoreBundle\Document\Place;

class SearchController extends Controller {
	/**
	 * @Route("/store/search/")
	 * @Method({ "HEAD", "GET" })
	 * @Template
	 */
	public function searchAction(Request $request)
	{
		$finder = $this->get('foq_elastica.finder.ileyeu.tag');
		$searchTerm = $request->query->get('search');
		$tags = $finder->find($searchTerm);
		return array('tags' => $tags);
	}

}
