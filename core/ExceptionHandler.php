<?php


namespace core;

/**
 * Class ExceptionHandler
 * @package core
 */
class ExceptionHandler
{
    /**
     * Affiche une exception en cas d'erreur
     * @param string $name Nom de l'exception
     * @param mixed $error stackTrace de l'exception
     */
    public static function raiseException(string $name, $error)
    {
        Application::$app->response->setStatusCode(500);
        if(Application::$app->config['debug'])
        {
            (new View())->render("errors/exception.debug.php", [
                'name' => $name,
                'error' => $error
            ]);
        }
        else
        {
            (new View())->render("errors/exception.php");
        }

        exit;
    }
}