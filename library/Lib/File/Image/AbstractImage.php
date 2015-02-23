<?php
/**
 * Created by PhpStorm.
 * User: Edvaldo
 * Date: 16/02/2015
 * Time: 23:12
 */

namespace Lib\File\Image;

use Lib\File\AbstractFile;

abstract class AbstractImage extends AbstractFile implements ImageInterface {

    public function crop($width, $height)
    {
        echo "CROP";
    }
} 