<?php

namespace core;

/**
 * Class CSRFValidation
 * @package core
 */
class CSRFValidation
{

    /**
     * CSRFValidation constructor.
     * Crée un token CSRF s'il n'existe pas
     */
    public function __construct()
    {
        if (!isset($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    /**
     * Vérifie le token CSRF, affiche un 419 si token incorrect
     * @param string $method Méthode (get ou post)
     * @param string $token teste si le token correspond à celui de l'utilisateur
     */
    public function validate(string $method, string $token)
    {
        if (!isset($_SESSION['csrf']) || ($method === 'post' && strcmp($_SESSION['csrf'], $token) !== 0))
        {
            (new View())->showError(419, "Page expirée");
        }
    }
}