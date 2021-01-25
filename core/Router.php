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

    private array $args = [];

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

        $callback = $this->match($method, $path);

        if ($callback === false)
        {
            echo "404 - Not Found<br>";
            exit;
        }

        call_user_func_array($callback, $this->args);
    }

    private function match(string $method, string $path)
    {
        $callback = $this->routes[$method][$path] ?? false;
        $remainingRoutes = $this->routes[$method];

        while ($remainingRoutes != [] && $callback === false)
        {
            $route = array_key_first($remainingRoutes);

            if (strpos($route, '{'))
            {
                $url = trim($path, '/');
                $out = preg_replace("#{(\w+)}#", '([^/]+)', $route);
                $out = trim($out, '/');

                if (preg_match("#^$out$#", $url, $matches))
                {
                    $callback = $this->routes[$method][$route];
                }

                array_shift($matches);
                $this->args = $matches;
            }

            array_shift($remainingRoutes);
        }

        if (is_array($callback))
        {
            $callback[0] = new $callback[0];
        }

        if (is_string($callback))
        {
            $action = $callback;
            $callback = [];
            $callback[0] = new $action;
            $callback[1] = 'index';
        }

        if ($callback === [])
        {
            $callback = false;
        }

        return $callback;
    }
}