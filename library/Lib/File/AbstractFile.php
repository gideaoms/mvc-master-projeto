<?php
/**
 * Created by PhpStorm.
 * User: Edvaldo
 * Date: 16/02/2015
 * Time: 22:21
 */

namespace Lib\File;

abstract class AbstractFile implements FileInterface
{
    private $path;
    private $dirname;
    private $basename;
    private $filename;
    private $extension;
    private $content;

    public function __construct($path)
    {
        $this->path = $path;
        $this->dirname = pathinfo($this->path, PATHINFO_DIRNAME);
        $this->basename = pathinfo($this->path, PATHINFO_BASENAME);
        $this->filename = pathinfo($this->path, PATHINFO_FILENAME);
        $this->extension = pathinfo($this->path, PATHINFO_EXTENSION);
    }

    public function copy($path, $overwrite = false)
    {
        if (!$this->exists())
            throw new \Exception("File not found");

        if (!file_exists(dirname($path)))
            throw new \Exception("Directory does not exists");
        elseif (!$overwrite && file_exists($path))
            throw new \Exception("Destination file already exists. Overwrite?");

        copy($this->path, $path);
    }

    public function rename($name)
    {
        if (!$this->exists())
            throw new \Exception("File not found");

        rename($this->path, $name);
    }

    public function delete()
    {
        if (!$this->exists())
            throw new \Exception("File not found");

        unset($this->path);
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function exists()
    {
        return (file_exists($this->path) && is_file($this->path));
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
} 