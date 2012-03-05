<?php

namespace TripShaper\AdminBundle\Controller\Tag;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SuggestController extends ContainerAware
{
	/**
	 * @Route("admin/tags/suggest", name="_suggestTagsByTerm", defaults={"format" = "json"} )
	 * @Method({"GET"})
	 */
	public function suggestByTerm(Request $request)
	{
		$finder = $this->container->get('foq_elastica.finder.ileyeu.tag');
		$tags = $finder->find($request->query->get('term') . '*');

/*		$tags = $this->get('doctrine.odm.mongodb.document_manager')
		->getRepository('TripShaperStoreBundle:Tag')
		->findAll();
*/

		$tags_json = array();
		foreach($tags as $tag)
		{
			$tags_json[] = array(
				'id' => $tag->getTerm(),
				'label' => $tag->getTerm(),
				'value' => $tag->getTerm(),
			);
		}

		$response = new Response(json_encode($tags_json));
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}

}
