<?php
/**
 * Created by PhpStorm.
 * User: Programação Web
 * Date: 05/02/2015
 * Time: 09:52
 */

namespace Lib\Auth;

use Lib\Session\StorageInterface;
use Lib\Session\Storage as SessionStorage;

class Authentication implements AuthenticationInterface
{
    private $user;
    private $storage;

    public function __construct(StorageInterface $storage = null)
    {
        $this->storage = null !== $storage ? $storage : new SessionStorage();
    }

    public function verify()
    {

    }
} 