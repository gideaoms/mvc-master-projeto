<?php

namespace Application\Controller;

use Lib\Controller\AbstractController;
use Application\View\ApplicationView;
use Administrator\Model\MenuModel;

class HomeController extends AbstractController
{
    private $menu;
    private $arrayMenu = array();

    public function indexAction()
    {
        $view = new ApplicationView("home/home");
        $this->menu = new MenuModel();   
        $menuSuperior = $this->menu->listMenuSuperior();
        while($menuSuperior->next()) :
            $this->arrayMenu[$menuSuperior->getValue("id_menu")] = array(
                "ds_menu"  => $menuSuperior->getValue("ds_menu"),
                "ds_url"   => $menuSuperior->getValue("ds_url"),
                "sub_menu" => $this->listarSubMenu($menuSuperior->getValue("id_menu"))
            );            
        endwhile;
        $view->setArrayMenu($this->arrayMenu);
        return $view;
    }

    private function listarSubMenu($id_menu)
    {
        $this->menu->idMenuSuperior = $id_menu;
        $subMenu = $this->menu->listSubMenu();
        if ($subMenu->count() > 0)
        {
            while ($subMenu->next())
            {
                $array[$subMenu->getValue("id_menu")] = array(
                    "ds_menu"  => $subMenu->getValue("ds_menu"),
                    "ds_url"   => $subMenu->getValue("ds_url"),
                    "sub_menu" => $this->listarSubMenu($subMenu->getValue("id_menu"))
                );
            }
            return $array;
        }
    }
}