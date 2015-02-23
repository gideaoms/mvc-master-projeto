<?php
/**
 * Created by PhpStorm.
 * User: Programação Web
 * Date: 05/02/2015
 * Time: 09:54
 */

namespace Lib\Session;

class Storage implements StorageInterface {

    private $session;
    private $namespace;

    public function __construct($namespace = "SESS", $cookie = "PHPSESSID")
    {
        if (!isset($_SESSION)) {
            session_start();
            session_regenerate_id(true);
            session_name($cookie);
        }
        $this->session = $_SESSION;
        $this->setNamespace($namespace);
    }

    /**
     * Verifica se existe o indice informado
     *
     * @param $name
     * @return bool
     */
    public function exists($name)
    {
        return isset($this->session[$this->namespace][$name]);
    }

    /**
     * Escreve informações na sessão
     *
     * @param $name
     * @param $value
     */
    public function write($name, $value)
    {
        $this->session[$this->namespace][$name] = $value;
    }

    /**
     * Lê informações na sessão
     *
     * @param $name
     * @return mixed
     */
    public function read($name)
    {
        return isset($this->session[$this->namespace][$name]) ? $this->session[$this->namespace][$name] : null;
    }

    /**
     * Exclui o indice da sessão
     *
     * @param $name
     * @return bool
     */
    public function delete($name)
    {
        unset($this->session[$this->namespace][$name]);
        return true;
    }

    /**
     * Modifica a namespace atual
     *
     * @param $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Retorna a namespace atual
     *
     * @return string
     */
    public function getNamespace()
    {
        return (string) $this->namespace;
    }

    /**
     * Salva as informações modificadas na sessão
     */
    public function __destruct()
    {
        $_SESSION = (array) $this->session;
    }
}