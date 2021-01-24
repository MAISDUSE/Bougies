<?php

namespace core;

/**
 * @author Hugo
 * Class Route, used to create uro associations
 */
class Route
{
    public static array $routes = [];

    public static function get($uri, $callback)
    {
        self::$routes['get'][$uri] = $callback;
    }

    public static function post($uri, $callback)
    {
        self::$routes['post'][$uri] = $callback;
    }
}