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

	public function update()
	{
		$sql = "update menu set ds_menu = ? , situacao = ?, ds_url = ?, id_menu_superior = ? where id_menu = ?";
		$values = array($this->dsMenu, $this->situacao, $this->dsUrl, empty($this->idMenuSuperior) ? null : $this->idMenuSuperior, $this->idMenu);
		$this->getConnection()->execute($sql, $values);
	}

	public function delete()
	{
		$sql = "delete from menu where id_menu = ?";
		$values = array($this->idMenu);
		$this->getConnection()->execute($sql, $values);
	}

	public function getMenus()
	{
		/** pega todos os menus ativos para listar no select como opcao de menu superior */
		$sql = "select m.id_menu, m.ds_menu, m.ds_url from menu m "
			. "where m.situacao = 'A' "
			. "order by m.nr_ordenacao";
		return $this->getConnection()->query($sql);
	}

	public function getMenuEdit()
	{
		/** pega os dados de um menu para editar */
		$sql = "select m.id_menu, m.ds_menu, m.situacao, m.ds_url, m.dt_cadastro, m.nr_ordenacao, m.id_menu_superior "
			. "from menu m where m.id_menu = ?";
		$values = array($this->idMenu);
		return $this->getConnection()->query($sql, $values);
	}

	public function getMenusList()
	{
		/** pega todos os menus cadastrados para listar tabela */
		$sql = "select m.id_menu, m.ds_menu, "
			. "case m.situacao when 'A'	then 'Ativo' when 'I' then 'Inativo' end as situacao, "
			. "m.ds_url, m.dt_cadastro, m2.ds_menu as menu_superior from menu m "
			. "left join menu m2 on (m2.id_menu = m.id_menu_superior) "
			. "order by m.nr_ordenacao";
		return $this->getConnection()->query($sql);
	}

	public function listMenuSuperior()
	{
		/** listar os menus superiores ativos */
		$sql = "select m.id_menu, m.ds_menu, m.ds_url from menu m "
			. "where m.situacao = 'A' and m.id_menu_superior is null";
		return $this->getConnection()->query($sql);
	}

	public function listSubMenu()
	{
		/** listar os submenus de um determinado menu passado por parametro */
		$sql = "select m.id_menu, m.ds_menu, m.ds_url from menu m "
			. "where m.situacao = 'A' and m.id_menu_superior = ?";
		$value = array($this->idMenuSuperior);
		return $this->getConnection()->query($sql, $value);
	}

	private function lastMenu()
	{
		/** pega a quantidade de menu cadastrados para trabalhar com ordenacao */
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