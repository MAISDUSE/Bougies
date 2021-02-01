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

    /**
     * @var string $method méthode de la route
     */
    public string $method;

    /**
     * @var string $route url de la route
     */
    public string $route;

    /**
     * Route constructor.
     * @param string $method méthode
     * @param string $uri url
     * @param $callback callback
     */
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

    /**
     * Protection de la route
     * @param string $permission Permission
     */
    public function perm(string $permission)
    {
        if(!Auth::can($permission)) unset(self::$routes[$this->method][$this->route]);
    }
}