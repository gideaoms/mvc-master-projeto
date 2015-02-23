<?php

namespace Autoload;

class Loader
{
	private static $loader;

	private function __construct() {}

	public static function init()
	{
		if (null == self::$loader) {
			self::$loader = new self;
            self::$loader->register();
		}
	}

	private function findFile($class, $dir = "")
	{
        $file = ltrim($class, "\\");
        $path = BASEPATH . DS . $dir . $file . ".php";
        $path = str_replace("\\", DS, $path);

        if (file_exists($path)) {
            require_once $path;
        }
	}

	private function loadLibrary($class)
	{
        self::$loader->findFile($class, "library/");
	}

	private function loadModule($class)
	{
        self::$loader->findFile($class, "module/");
	}

	public function register()
	{
		spl_autoload_register(array(self::$loader, "loadLibrary"));
		spl_autoload_register(array(self::$loader, "loadModule"));
	}
}

Loader::init();