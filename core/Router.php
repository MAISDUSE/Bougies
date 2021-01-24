<?php

namespace core;

/**
 * @author Hugo
 * Class Router handles uri parsing
 */
class Router
{
    public array $routes;

    public function __construct()
    {
        Application::$app->routerTest();
    }

    /**
     * gather all routes
     */
    public function getRoutes()
    {

    }
}