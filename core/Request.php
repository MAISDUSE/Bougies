<?php


namespace core;

/**
 * Class Request
 *
 * @package core
 */
class Request
{
    /**
     * Récupère l'url
     * @return string
     */
    public function getPath() : string
    {
        $path = $_SERVER['REQUEST_URI'];
        $pos = strpos($path, '?');

        return ($pos === false)? $path : substr($path, 0, $pos);
    }

    /**
     * Récupère la méthode en minuscule (get, post)
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}