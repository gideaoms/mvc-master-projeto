<?php

namespace Lib\Controller;

use Lib\Http\Request;

abstract class AbstractController implements ControllerInterface
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function init() {}

    public function getRequest()
    {
        return $this->request;
    }

    protected function jsonPostSuccess() {
        echo json_encode(["message" => "Gravado com sucesso", "redirect" => "admin/menu/listar"]);
    }

    protected function jsonUpdatSuccess() {
        echo json_encode(["message" => "Alterado com sucesso", "redirect" => "admin/menu/listar"]);
    }

    protected function jsonDeleteSuccess() {
        echo json_encode(["message" => "Excluído com sucesso", "redirect" => "admin/menu/listar"]);
    }
} 