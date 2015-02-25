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

    public function editarAction($id)
    {
        $view = new AdministratorView("menu/edit");
        $menu = new MenuModel();
        $view->setMenuSuperior($menu->getMenus());
        $menu->idMenu = $id;
        $resultset = $menu->getMenuEdit();
        $menu->idMenuSuperior = $resultset->getValue("id_menu_superior");
        $menu->dsMenu = $resultset->getValue("ds_menu");
        $menu->dsUrl = $resultset->getValue("ds_url");
        $menu->situacao = $resultset->getValue("situacao");
        $view->setMenuClass($menu);
        return $view;
    }

    public function listarAction()
    {
        $view = new AdministratorView("menu/list");
        $menu = new MenuModel();
        $view->setMenuSuperior($menu->getMenusList());
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
        $this->jsonPostSuccess();
    }

    public function atualizarAction()
    {
        $date = new DateHelper();
        $menu = new MenuModel();
        $menu->idMenu         = $this->getRequest()->getPost("id_menu");
        $menu->idMenuSuperior = $this->getRequest()->getPost("id_menu_superior");
        $menu->dsMenu         = $this->getRequest()->getPost("ds_menu");
        $menu->situacao       = $this->getRequest()->getPost("ds_situacao");
        $menu->dsUrl          = $this->getRequest()->getPost("ds_url");        
        //$menu->dtCadastro     = $date->getDateActual();
        $menu->update();
        $this->jsonUpdatSuccess();
    }

    public function excluirAction()
    {
        $menu = new MenuModel();
        $menu->idMenu = $this->getRequest()->getPost("id");
        $menu->delete();
        $this->jsonDeleteSuccess();
    }

}

?>