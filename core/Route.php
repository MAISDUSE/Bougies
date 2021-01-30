<?php

namespace core;

use core\Authentication as Auth;

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

    public string $method;
    public string $route;

    public function __construct(string $method, string $uri, $callback)
    {
        self::$routes[$method][$uri] = $callback;

        $this->method = $method;
        $this->route = $uri;
    }

    /**
     * Stocke une route en get dans le tableau des routes
     * @param string $uri Identifiant de la route
     * @param mixed $callback action à mener
     * @return Route Instance de la route
     */
    public static function get(string $uri, $callback): Route
    {
        return new self('get', $uri, $callback);
    }

    /**
     * Stocke une route en post dans le tableau des routes
     * @param string $uri Identifiant de la route
     * @param mixed $callback action à mener
     * @return Route Instance de la route
     */
    public static function post(string $uri, $callback)
    {
        return new self('post', $uri, $callback);
    }

    public function perm(string $permission)
    {
        if(!Auth::can($permission)) unset(self::$routes[$this->method][$this->route]);
    }
}