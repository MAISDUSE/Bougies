<?php

namespace core;

use app\config\Config;

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
     * @var Database $db Instance de la BDD
     */
    public Database $db;

    /**
     * Contient la configuration
     * @var array $config
     */
    public array $config;

    /**
     * Application constructor. Défini le singleton et instancie un Router
     */
    public function __construct()
    {
        self::$app = $this;

        $this->router = new Router();

        $this->config = Config::loadConfig();

        $this->db = new Database($this->config);
    }

    /**
     * Lance le traitement, appelle la fonction de résolution de l'url sur le router
     */
    public function run()
    {
        $this->router->resolveRoute();
    }
}
