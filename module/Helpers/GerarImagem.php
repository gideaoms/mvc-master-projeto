<?php

namespace Helpers;

class GerarImagem
{

    private $public = "public/";
    private $path_img_originais = "upload/imagens_originais/";
    private $path_img_geradas = "upload/imagens_geradas/";

    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function gerarJpg()
    {
        $width = empty($_POST['area']['width']) ? 300 : sprintf('%d', $_POST['area']['width']);
        $height = empty($_POST['area']['height']) ? 450 : sprintf('%d', $_POST['area']['height']);

        $img = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($img, 255, 255, 255);
        imagefilledrectangle($img, 0, 0, $width, $height, $white);

        if (!empty($_POST['itens']))
        {
            foreach ($_POST['itens'] as $item)
            {
                if (!empty($item['src']))
                {
                    /* pegamos somente o nome do arquivo e ignoramos o restante, vamos procurar por ela dentro da pasta "imagens_originais" */
                    //$filename = $this->public . $this->path_img_originais . pathinfo($item['src'], PATHINFO_BASENAME);
                    $filename = $this->public . $item['src'];
                    if (file_exists($filename))
                    {
                        $w = sprintf('%d', $item['width']);
                        $h = sprintf('%d', $item['height']);
                        $x = sprintf('%d', $item['x']);
                        $y = sprintf('%d', $item['y']);

                        /* criamos o elemento de imagem no PHP a partir do conteudo do arquivo */
                        $item = imagecreatefromstring(file_get_contents($filename));

                        /* copiamos a imagem informada na imagem final, com as medidas e posições informadas */
                        imagecopy($img, $item, $x, $y, 0, 0, $w, $h);
                    }
                }
            }
        }

        /* geramos o arquivo final */
        $imageFileName = $this->path_img_geradas . date('YmdHis') . '.jpg';
        imagejpeg($img, $this->public . $imageFileName, 90);

        /* informamos o link */
        return $imageFileName;
    }

}