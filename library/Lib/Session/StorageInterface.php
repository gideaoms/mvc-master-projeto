<?php
/**
 * Created by PhpStorm.
 * User: Programação Web
 * Date: 05/02/2015
 * Time: 09:54
 */

namespace Lib\Session;

interface StorageInterface
{
    public function exists($name);

    public function write($name, $value);

    public function read($name);

    public function delete($name);

    public function setNamespace($namespace);

    public function getNamespace();
} 