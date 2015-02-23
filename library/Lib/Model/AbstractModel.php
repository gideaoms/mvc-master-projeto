<?php

namespace Lib\Model;

use Lib\Application;
use Lib\Database\Connection;

abstract class AbstractModel implements ModelInterface
{
    private static $connection;

    public function getConnection()
    {
        $database = Application::getConfig("database");
        if (null == self::$connection)
        {
            self::$connection = new Connection($database->hostname, $database->username, $database->password, $database->dbname);
        }
        return self::$connection;
    }
} 