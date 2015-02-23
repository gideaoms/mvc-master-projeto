<?php

namespace Application\Controller;

use Helpers\GerarImagem;
use Lib\Controller\AbstractController;
use Helpers\UploadHelper;

class PublicacaoController extends AbstractController
{
    public function postPhotoAction()
    {
        $upload = new UploadHelper("imagem");
        $fotos = $upload->save('imagens_originais');
        $this->jsonShow($fotos);
    }

    public function gerarImagemAction()
    {
        $gerar = new GerarImagem();
        $link = $gerar->gerarJpg();
        $this->jsonShow(array('url' => $link));
    }
}

?>