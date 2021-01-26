<?php


namespace core;

/**
 * Class Response
 * @package core
 */
class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    /**
     * Redirige vers l'url passée en paramètre
     * @param string $url Url cible
     */
    public function redirect(string $url)
    {
        header("Location: $url");

        exit;
    }
}