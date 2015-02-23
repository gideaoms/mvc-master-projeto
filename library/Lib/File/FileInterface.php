<?php
/**
 * Created by PhpStorm.
 * User: Edvaldo
 * Date: 16/02/2015
 * Time: 22:21
 */

namespace Lib\File;

interface FileInterface {

    public function save();

    public function saveAs($name);

    public function copy($path, $overwrite = false);

    public function rename($name);

    public function delete();
} 