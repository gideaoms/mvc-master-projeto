<?php

namespace Lib;

class Application
{
    private static $instance;
    private static $config;

    private $module = "Application";
    private $controller = "home";
    private $action = "index";
    private $params = array();

    private function __construct($config)
    {
        self::$config = $config;
        $routes = isset(self::$config['routes']) ? self::$config['routes'] : array();
        $url = preg_replace('/\/{2,}/', '/', substr($_SERVER['REQUEST_URI'], 1)); // Caso exista duas ou mais barras juntas, substitui por uma apenas
        $explode = preg_replace("/\?.*$/i", "", $url); // Retira da URL o que não é importante

        foreach ($routes as $route => $module)
        {
            $route = str_replace('/', '\/', $route);
            $pattern = "/^{$route}\/?([^?]*)/i";
            if (preg_match($pattern, $url, $vars)) {
                $this->module = $module;
                $explode = $vars[1];
                break;
            }
        }

        $this->parseUrl($explode);
        $this->run();
    }

    /**
     * Inicia a aplicação
     *
     * @param null $config
     */
    public static function init($config = null) {
        if (null == self::$instance) {
            self::$instance = new self($config);
        }
    }

    /**
     * Obtem uma diretiva de configuração do arquivo
     *
     * @param $name
     * @return object
     */
    public static function getConfig($name)
    {
        return (object) (isset(self::$config[$name]) ? self::$config[$name] : array());
    }

    /**
     * Faz o tratamento da URL
     *
     * @param $string
     */
    private function parseUrl($string)
    {
        $parts = explode("/", $string);
        /*
         * Funciona como empty. Verifica se o primeiro indice da string existe, caso não exista a string está vazia.
         * A vantagem é que caso a variável não exista não é gerado mensagem de erro do PHP
         */
        if (isset($parts[0][0])) {
            $this->controller = $parts[0];
            if (isset($parts[1][0])) {
                $this->action = $parts[1];
                if (isset($parts[2][0])) {
                    unset($parts[0], $parts[1]); // Excluindo os dois primeiros indices, sobram apenas os parametros
                    $this->params = $parts;
                }
            }
        }
    }

    /**
     * Roda a aplicação
     */
    private function run()
    {
        $class = "\\{$this->module}\Controller\\" . ucfirst($this->controller) . "Controller";
        $action = "{$this->action}Action";

        if (class_exists($class)) {
            $controller = new $class;
            $controller->init();
            if (method_exists($controller, $action)) {
                // A action é a última função a ser executada
                exit(call_user_func_array(array($controller, $action), $this->params));
            } else {
                exit("<h1>Page Not Found</h1>");
            }
        } else {
            exit("<h1>Page Not Found</h1>");
        }
    }
} 