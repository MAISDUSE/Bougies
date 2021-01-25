<?php

namespace core;

/**
 * Class Application
 * @package core
 */
class Application
{
    /**
     * @var Application $app Singleton correspondant à l'application
     */
    public static Application $app;

    /**
     * @var Router $router Instance du router
     */
    public Router $router;

    /**
     * Application constructor. Défini le singleton et instancie un Router
     */
    public function __construct()
    {
        self::$app = $this;

        $this->router = new Router();
    }

    /**
     * Lance le traitement, appelle la fonction de résolution de l'url sur le router
     */
    public function run()
    {
        $this->router->resolveRoute();
    }
}
