<?php

namespace Lib\ServiceManager;

use SplObjectStorage;

class Container {

    private $factories;

    public function __construct()
    {
        $this->factories = new SplObjectStorage();
    }
}