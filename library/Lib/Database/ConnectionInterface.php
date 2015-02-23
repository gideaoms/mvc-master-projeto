<?php

namespace Lib\Database;

interface ConnectionInterface {

    public function execute($sql, $data = null);

    public function query($sql, $data = null);
}
