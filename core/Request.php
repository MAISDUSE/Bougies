<?php

namespace core;

/**
 * Class Request
 *
 * @package core
 */
class Request
{
    public CSRFValidation $csrf;

    public function __construct()
    {
        $this->csrf = new CSRFValidation();
    }

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
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $this->csrf->validate($method, $this->post('csrf'));

        return $method;
    }

    public function post($var = false)
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $value = $_POST[$var] ?? false;

        return ($var === false)? $_POST : $value;
    }
}