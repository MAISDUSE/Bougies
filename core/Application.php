<?php

namespace core;

/**
 * @author Hugo
 * Main class
 */
class Application
{
    //Main application singleton
    public static Application $app;

    //Router instance
    public Router $router;

    public function __construct()
    {
        self::$app = $this;

        $this->router = new Router();
    }

    public function run()
    {
        $this->router->resolveRoute();
    }
}