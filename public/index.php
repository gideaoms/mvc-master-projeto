<?php

define("BASEPATH", dirname(__DIR__));
define("DS", DIRECTORY_SEPARATOR);

chdir(BASEPATH);

require_once "library/autoload.php";

\Lib\Application::init(require "/config/application.config.php");