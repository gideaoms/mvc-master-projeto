<?php

namespace Administrator\View;

define("VIEWPATH", __DIR__);

use Lib\View\AbstractView;

class AdministratorView extends AbstractView
{
	
	private $menu;

	public function setMenuSuperior($menuSuperior)
	{
		$this->menu = $menuSuperior;
	}

	public function getMenuSuperior()
	{
		return $this->menu;
	}

}