<?php


namespace core;

/**
 * Class Response
 * @package core
 */
class Response
{
    /**
     * Défini le code de statut envoyé au navigateur (404, 500, etc...)
     * @param int $code
     */
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