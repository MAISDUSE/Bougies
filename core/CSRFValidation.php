<?php


namespace core;


class CSRFValidation
{

    /**
     * CSRFValidation constructor.
     */
    public function __construct()
    {
        if (!isset($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    public function validate(string $method, string $token)
    {
        if (!isset($_SESSION['csrf']) || ($method === 'post' && strcmp($_SESSION['csrf'], $token) !== 0))
        {
            (new View())->showError(419, "Page expirée");
        }
    }
}