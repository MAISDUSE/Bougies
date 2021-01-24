<?php


namespace core;


class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $pos = strpos($path, '?');

        return ($pos === false)? $path : substr($path, 0, $pos);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}