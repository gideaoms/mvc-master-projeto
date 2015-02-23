<?php
namespace Lib\Database;

interface ResultSetInterface {

    /**
     * Posiciona o cursor no primeiro registro
     */
    public function first();

    /**
     * Posiciona o cursor no próximo registro
     */
    public function next();

    /**
     * Retorna a quantidade de resgistro
     */
    public function count();

    /**
     * Retorna um valor em uma posição específica
     *
     * @param string $index
     * @param string $name
     */
    public function getValueAt($index, $name);

    /**
     * Retorna o valor na posição atual do cursor
     *
     * @param string $name
     */
    public function getValue($name);

    /**
     * Retorna o valor como inteiro
     *
     * @param string $name
     */
    public function getInt($name);

    /**
     * Retorna o valor como float
     *
     * @param string $name
     */
    public function getFloat($name);

    /**
     * Retorna o conjunto de dados inteiro como array
     */
    public function asArray();
}