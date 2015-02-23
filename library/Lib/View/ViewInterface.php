<?php

namespace Lib\View;

interface ViewInterface
{
    public function getLanguage();

    public function getCharset();

    public function getStyleSheet();

    public function getJavaScript();

    public function getTitle();

    public function getBody();
} 