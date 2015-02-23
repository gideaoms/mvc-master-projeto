<?php
/**
 * Created by PhpStorm.
 * User: Edvaldo
 * Date: 16/02/2015
 * Time: 23:02
 */

namespace Lib\File\Image;

class JpegImage extends AbstractImage
{
    public function __construct($path)
    {
        parent::__construct($path);
        if ($this->exists()) {
            $content = @imageCreateFromJpeg($this->getPath());
            if ($content)
                $this->setContent($content);
        }
    }

    public function save()
    {
        imageJpeg($this->getContent(), $this->getPath(), 100);
    }

    public function saveAs($name)
    {
        imageJpeg($this->getContent(), $name, 100);
    }

    public function show()
    {
        header("content-type: image/jpg");
        exit(imageJpeg($this->getContent()));
    }
} 