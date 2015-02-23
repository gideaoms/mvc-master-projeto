<?php
/**
 * Created by PhpStorm.
 * User: Edvaldo
 * Date: 16/02/2015
 * Time: 22:30
 */

namespace Lib\File;

class TextFile extends AbstractFile
{
    public function __construct($path)
    {
        parent::__construct($path);
        if ($this->exists()) {
            $this->setContent(file_get_contents($this->getPath()));
        }
    }

    public function save()
    {
        file_put_contents($this->getPath(), $this->getContent());
    }

    public function saveAs($name)
    {
        file_put_contents($name, $this->getContent());
    }

    public function search($text)
    {
        return preg_match("/{$text}/i", $this->getContent());
    }

    public function addContent($content)
    {
        $content = $this->getContent() + $content;
        $this->addContent($content);
    }
} 