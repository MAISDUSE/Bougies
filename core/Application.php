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
        Application::$app = $this;

        $this->router = new Router();
    }

    public function routerTest()
    {
        echo "Router test<br>";
    }

    public function run()
    {
        echo "it's alive!<br>";
    }
}