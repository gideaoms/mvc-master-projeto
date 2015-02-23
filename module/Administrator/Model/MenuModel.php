<?php

namespace Administrator\Model;

use Lib\Model\AbstractModel;

class MenuModel extends AbstractModel {

	private $idMenu;
	private $dsMenu;
	private $situacao;
	private $dsUrl;
	private $dtCadastro;
	private $nrOrdenacao;
	private $idMenuSuperior;

	public function insert()
	{
		$sql = "insert into menu (ds_menu, situacao, ds_url, dt_cadastro, nr_ordenacao, id_menu_superior) "
				."values (?, ?, ?, ?, ?, ?)";
		$this->nr_ordenacao = $this->lastMenu()->getValue("last");
		$values = array($this->dsMenu, $this->situacao, $this->dsUrl, $this->dtCadastro, $this->nr_ordenacao, empty($this->idMenuSuperior) ? null : $this->idMenuSuperior);
		$this->getConnection()->execute($sql, $values);
	}

	public function getMenus()
	{
		$sql = "select m.id_menu, m.ds_menu, m.ds_url from menu m "
			. "where m.situacao = 'A' "
			. "order by m.nr_ordenacao";
		return $this->getConnection()->query($sql);		
	}

	private function lastMenu()
	{
		$sql = "select count(m.id_menu) + 1 as last from menu m";
		return $this->getConnection()->query($sql);
	}

	public function __set($campo, $value)
	{
		$this->$campo = $value;
	}

	public function __get($campo)
	{
		return $this->$campo;
	}
}

?>