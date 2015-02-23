<?php

namespace Administrator\Controller;

use Administrator\View\AdministratorView;
use Lib\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        $view = new AdministratorView("home/home");
        return $view;
    }
}