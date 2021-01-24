<?php

namespace core;

/**
 * @author Hugo
 * Class Router handles uri parsing
 */
class Router
{
    public array $routes;
    public const ROUTES_PATH = "../routes";

    public function __construct()
    {
        Application::$app->routerTest();

        $this->getRoutes();
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
    }
}