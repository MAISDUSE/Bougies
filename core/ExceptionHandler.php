<?php


namespace core;


class ExceptionHandler
{
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