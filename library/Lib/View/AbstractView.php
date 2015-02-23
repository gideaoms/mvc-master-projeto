<?php

namespace Lib\View;

defined("VIEWPATH") or exit("Necessario definir a constante VIEWPATH no arquivo");

use \Exception;

abstract class AbstractView implements ViewInterface
{
    private $language = "Pt-BR";
    private $charset = "UTF-8";
    private $title = "Home";

    private $stylesheet = array();
    private $javascript = array();

    private $path;

    public function __construct($file)
    {
        $this->path = VIEWPATH . DS . $file . ".phtml";
        if (!file_exists($this->path))
        {
            throw new Exception("View file not found");
        }
    }

    /**
     * Retorna a linguagem do documento HTML (padrão Pt-BR)
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Retorna a codificação do documento HTML (padrão UTF-8)
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Adiciona um documento CSS a página
     *
     * @param $href Endereço do arquivo CSS
     * @param string $media Qual media será aplicado (padrão all)
     */
    public function addStyleSheet($href, $media = "all")
    {
        $this->stylesheet[] = array(
            "href" => $href,
            "media" => $media
        );
        return $this;
    }

    /**
     * Obtem a lista de arquivos CSS adicionados
     */
    public function getStyleSheet()
    {
        $out = "";
        foreach($this->stylesheet as $stylesheet)
        {
            $out .= "<link rel=\"stylesheet\" media=\"{$stylesheet['media']}\" href=\"{$stylesheet['href']}\">\n";
        }
        echo $out;
    }

    /**
     * Adiciona o documento JavaScript a página
     *
     * @param $src Endereço do arquivo javaScript
     * @param string $type Tipo de arquivo (padrão text/javascript)
     */
    public function addJavaScript($src, $type = "text/javascript")
    {
        $this->javascript[] = array(
            "src" => $src,
            "type" => $type
        );
        return $this;
    }

    /**
     * Obtem a lista de arquivos JavaScript adicionados
     */
    public function getJavaScript()
    {
        $out = "";
        foreach($this->javascript as $javascript)
        {
            $out .= "<script type=\"{$javascript['type']}\" src=\"{$javascript['src']}\"></script>\n";
        }
        echo $out;
    }

    /**
     * Modifica o título do documento
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Retorna o título do documento
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Inclui o arquivo com o conteúdo
     */
    public function getBody()
    {
        include $this->path;
    }

    /**
     * Retorna o conteúdo devidamente formatado para exibição no browser
     *
     * @return string
     */
    public function __toString()
    {
        ob_start(); // Ativa o buffer de saída e não mostra o conteúdo na tela
        include VIEWPATH . "/layout/layout.phtml";
        $content = ob_get_contents(); // Pega o conteúdo do include
        ob_end_clean();
        return $content; // Retorna o conteúdo sem mostar nada na tela
    }
} 