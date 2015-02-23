<?php

namespace Application\View;

define("VIEWPATH", __DIR__);

use Lib\View\AbstractView;

class ApplicationView extends AbstractView
{
    public $paginaArual;

    public function setPaginaAtual($pagina)
    {
        $this->paginaArual = $pagina;
    }

    public function getMenu() {
        return array(
            "Home",
            "Sobre",
            "Contato"
        );
    }

}