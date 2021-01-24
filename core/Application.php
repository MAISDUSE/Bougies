<?php

namespace core;

/**
 * @author Hugo
 * Main class
 */
class Application
{
    //Router instance
    public Router $router;
    //Main application singleton
    public static Application $app;

    public function __construct()
    {
        Application::$app = $this;
        $this->router = new Router();
    }

    public function run()
    {
        echo "it's alive!<br>";
    }

    public function routerTest()
    {
        echo "Router test<br>";
    }
}