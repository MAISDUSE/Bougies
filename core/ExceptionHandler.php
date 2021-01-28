<?php


namespace core;


class ExceptionHandler
{
    public static function raiseException(string $name, string $error)
    {
        (new View())->render("errors/exception.php", [
            'name' => $name,
            'error' => $error
        ]);

        exit;
    }
}