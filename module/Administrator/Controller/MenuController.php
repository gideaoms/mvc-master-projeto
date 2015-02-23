<?php

namespace Administrator\Controller;

use Administrator\View\AdministratorView;
use Lib\Controller\AbstractController;
use Administrator\Model\MenuModel;
use Helpers\DateHelper;

class MenuController extends AbstractController
{

    public function indexAction()
    {
        $view = new AdministratorView("menu/list");
        return $view;
    }

    public function cadastrarAction()
    {
        $view = new AdministratorView("menu/insert");
        $menu = new MenuModel();
        $view->setMenuSuperior($menu->getMenus());
        return $view;
    }

    public function gravarAction()
    {
        $date = new DateHelper();
        $menu = new MenuModel();
        $menu->idMenuSuperior = $this->getRequest()->getPost("id_menu_superior");
        $menu->dsMenu         = $this->getRequest()->getPost("ds_menu");
        $menu->situacao       = $this->getRequest()->getPost("ds_situacao");
        $menu->dsUrl          = $this->getRequest()->getPost("ds_url");        
        $menu->dtCadastro     = $date->getDateActual();
        $menu->insert();
    }

}

?>