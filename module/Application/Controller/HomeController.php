<?php

namespace Application\Controller;

use Lib\Controller\AbstractController;
use Application\View\ApplicationView;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        $view = new ApplicationView("home/home");
        $view->usuario = "Gideao";
        return $view;
    }

    public function post()
    {

    }

    public function usuarioAction() {
        $view = new ApplicationView("home/home");
        $view->setPaginaAtual("usuario");
        return $view;
    }
}