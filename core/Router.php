<?php

namespace core;

/**
 * @author Hugo
 * Class Router handles uri parsing
 */
class Router
{
    public array $routes;
    public Request $request;
    public const ROUTES_PATH = "../routes";

    public function __construct()
    {
        $this->getRoutes();

        $this->request = new Request();
    }

    /**
     * gather all routes
     */
    public function getRoutes()
    {
        $routeFiles = glob(Router::ROUTES_PATH.'/*.php');

        foreach ($routeFiles as $routeFile)
        {
            require_once "$routeFile";
        }

        $this->routes = Route::$routes;
    }

    public function resolveRoute()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false)
        {
            echo "404 - Not Found<br>";
            exit;
        }

        if (is_string($callback))
        {
            $callback = new $callback;
            return $callback->index();
        }

        if (is_array($callback))
        {
            $callback[0] = new $callback[0];
        }

        return call_user_func($callback);
    }
}