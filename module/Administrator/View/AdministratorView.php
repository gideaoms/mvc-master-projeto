<?php

namespace Administrator\View;

define("VIEWPATH", __DIR__);

use Lib\View\AbstractView;
use Helpers\DateHelper;

class AdministratorView extends AbstractView
{
	
	private $menu;
	private $menuClass;

	public function setMenuSuperior($menuSuperior)
	{
		$this->menu = $menuSuperior;
	}

	public function getMenuSuperior()
	{
		return $this->menu;
	}

	public function getDateBr($dt)
	{
		$date = new DateHelper();
		return $date->dateUsToBr($dt);
	}

	public function setMenuClass($menuClass)
	{
		$this->menuClass = $menuClass;
	}

	public function getMenuClass()
	{
		return $this->menuClass;
	}

}