<?php

namespace Application\View;

define("VIEWPATH", __DIR__);

use Lib\View\AbstractView;

class ApplicationView extends AbstractView
{
	private $arrayMenu;

    public function setArrayMenu($array)
    {
    	$this->arrayMenu = $array;
    }

    public function getArrayMenu()
    {
    	return $this->arrayMenu;
    }

    public function showMenu($submenu)
    {    	    	
		foreach ($submenu as $key => $value) : ?>			
			<?php if (!is_null($value["sub_menu"])) { ?>				
				<li class="has-sub">
					<a href="#"><?=$value["ds_menu"]; ?></a>
					<ul>
					<?= $this->showMenu($value["sub_menu"]); ?>
					</ul>
				</li>
			<?php } else { ?>
				<li>
					<a href="#"><?=$value["ds_menu"]; ?></a>					
				</li>
			<?php }?>
		<?php endforeach;
	}    	    
}