<?php

namespace Lib\Database;

use PDO;

class Connection implements ConnectionInterface {

    private $pdo;
    private $statement;
    public $debug = false;

    public function __construct($host, $user, $pass, $name, $charset = "UTF8") {
        $dsn = "mysql:host={$host};dbname={$name};charset={$charset}";
        $this->pdo = new PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Executa o comando SQL sem retornar valores
     *
     * @param $sql Comando SQL para execução
     * @param $data Parâmetros
     * @return boolean
     */
    public function execute($sql, $data = null) {
        if ($this->debug) {
            var_dump($sql, $data);
        }

        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($data);
        return true;
    }

    /**
     * Executa o comando SQL e retorna o resultado
     *
     * @param $sql
     * @param null $data
     * @return ResultSet
     */
    public function query($sql, $data = null) {
        $this->execute($sql, $data);
        return new ResultSet($this->statement->fetchAll());
    }

}
