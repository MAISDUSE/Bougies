<?php

namespace core;

/**
 * Class Route
 * @package core
 */
class Route
{
    /**
     * @var array $routes Tableau contenant les routes
     */
    public static array $routes = [];

    /**
     * Stocke une route en get dans le tableau des routes
     * @param string $uri Identifiant de la route
     * @param mixed $callback action à mener
     */
    public static function get(string $uri, $callback)
    {
        self::$routes['get'][$uri] = $callback;
    }

    /**
     * Stocke une route en post dans le tableau des routes
     * @param string $uri Identifiant de la route
     * @param mixed $callback action à mener
     */
    public static function post(string $uri, $callback)
    {
        self::$routes['post'][$uri] = $callback;
    }
}