<?php

namespace Administrator\Controller;

use Administrator\View\AdministratorView;
use Lib\Controller\AbstractController;

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
        return $view;
    }

    public function gravarAction()
    {
        var_dump($_POST);
    }

}

?>