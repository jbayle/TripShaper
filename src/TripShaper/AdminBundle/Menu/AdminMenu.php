<?php

namespace TripShaper\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminMenu
{
    private $factory;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @param Router $router
     */
    public function createAdminMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('id' => 'main_navigation', 'class'=>'menu')));
        $menu->setCurrentUri($request->getRequestUri());

        $submenu = $menu->addChild('Menu', array('uri' => '#'));
        $submenu->setLinkAttributes(array('class'=>'sub main'));
        $submenu->addChild('Trips', array('route' => 'TripShaper_AdminBundle_Trip_list'));
        $submenu->addChild('Maps', array('route' => 'TripShaper_AdminBundle_Map_list'));
        $submenu->addChild('Places', array('route' => 'TripShaper_AdminBundle_Place_list'));
        $submenu->addChild('Resources', array('route' => 'TripShaper_AdminBundle_Resource_list'));
        $submenu->addChild('Paths', array('route' => 'TripShaper_AdminBundle_Path_list'));
        $submenu->addChild('Tags', array('route' => 'TripShaper_AdminBundle_Tag_list'));

        return $menu;
    }
}

