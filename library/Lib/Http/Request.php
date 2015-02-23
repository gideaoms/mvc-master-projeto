<?php

namespace Lib\Http;

class Request {

    private $SERVER;

    public function __construct()
    {
        $this->SERVER = $_SERVER;
    }

    public function isPost()
    {
        return strtolower($this->SERVER["REQUEST_METHOD"]) == "post";
    }

    public function getParam($name)
    {
        return filter_input(INPUT_GET, $name);
    }

    public function getPost($name)
    {
        return filter_input(INPUT_POST, $name);
    }
} 