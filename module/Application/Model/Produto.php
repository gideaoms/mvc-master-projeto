<?php

namespace Application\Model;

use Application\View\ApplicationView;
use Lib\Model\AbstractModel;

class Produto extends AbstractModel
{
    public function listar()
    {
        $con = $this->getConnection();
    }
} 