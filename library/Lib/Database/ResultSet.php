<?php

namespace Lib\Database;

class ResultSet implements ResultSetInterface {

    private $index = -1;/*inicio em -1 para que ao passar no next o ondex valera 0 inciando a iteracao desde o primeiro indice do resultado*/
    private $length = 0;
    private $resource;

    public function __construct($resource) {
        $this->resource = is_array($resource) ? $resource : null;
        $this->length = count($resource);
    }

    /**
     * Posiciona o cursor no primeiro registro
     *
     * @return void
     */
    public function first() {
        $this->index = 0;
    }

    /**
     * Posiciona o cursor no próximo registro
     *
     * @return boolean
     */
    public function next() {
        if ($this->index < ($this->length - 1)) {
            $this->index++;
            return true;
        }
    }

    /**
     * Retorna a quantidade de registros
     *
     * @return int
     */
    public function count() {
        return $this->length;
    }

    /**
     * Obtem um valor em uma posição específica nos registros
     *
     * @param int $index
     * @param string $name
     * @return mixed|null
     */
    public function getValueAt($index, $name) {
        return isset($this->resource[$index]->$name) ? $this->resource[$index]->$name : null;
    }

    /**
     * Obtem o valor da posição atual do cursor
     *
     * @param string $name
     * @return mixed|null
     */
    public function getValue($name) {
        $this->setZero();
        return $this->getValueAt($this->index, $name);
    }

    /**
     * Obtem o valor da posição atual do cursor convertido em inteiro
     *
     * @param string $name
     * @return int
     */
    public function getInt($name) {
        $this->setZero();
        return (int) $this->getValueAt($this->index, $name);
    }

    /**
     * Obtem o valor da posição atual do cursor convertido em float
     *
     * @param string $name
     * @return float
     */
    public function getFloat($name) {
        $this->setZero();
        return (float) $this->getValueAt($this->index, $name);
    }

    /**
     * Obtem o valor da posição atual do cursor convertido em boolean
     *
     * @param string $name
     * @return bool
     */
    public function getBool($name) {
        $this->setZero();
        return (bool) $this->getValueAt($this->index, $name);
    }

    /**
     * Retorna o conjunto de dados em formato de matriz
     *
     * @return array
     */
    public function asArray() {
        return $this->resource;
    }

    /**
     * para zerar index caso ele esteja na posicao inicial que é -1, nesse nao existira a posicao -1
     */
    private function setZero() {
        if ($this->index < 0) $this->index = 0;
    }

}