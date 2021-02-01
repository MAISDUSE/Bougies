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
     * @var CSRFValidation $csrf Instance de CSRF
     */
    public CSRFValidation $csrf;

    /**
     * Request constructor.
     * Crée une instance de CSRF
     */
    public function __construct()
    {
        $this->csrf = new CSRFValidation();
    }

    /**
     * Récupère l'url
     * @return string url
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

    /**
     * Nettoie la variable post (ne filtre pas les quotes)
     * @param mixed $var Retourne la valeur de $_POST[$var]
     * @return mixed Retourne le tableau de post ou la valeur de $var
     */
    public function post($var = false)
    {
        $options = [];

        foreach (array_keys($_POST) as $key)
        {
            $options[$key] = ["filter" => FILTER_SANITIZE_STRING, "flags" => FILTER_FLAG_NO_ENCODE_QUOTES];
        }

        $_POST = filter_input_array(INPUT_POST, $options);

        $value = $_POST[$var] ?? false;

        return ($var === false)? $_POST : $value;
    }
}