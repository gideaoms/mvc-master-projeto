<?php

namespace Lib\Controller;

use Lib\Http\Request;

abstract class AbstractController implements ControllerInterface
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function init() {}

    public function getRequest()
    {
        return $this->request;
    }
} 