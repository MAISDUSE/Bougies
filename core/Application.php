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
     * @var Application $app Singleton correspondant à l'instance de l'application
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
     * @var Response $response Instance de la classe Response
     */
    public Response $response;

    /**
     * Contient la configuration
     * @var array $config
     */
    public array $config;

    /**
     * Application constructor.
     * Défini le singleton
     * Démarre la session
     * Charge la configuration
     * Crée une instance de Response
     * Crée une instance de Database
     * Crée une instance de Router
     */
    public function __construct()
    {
        self::$app = $this;

        session_start();

        $this->config = Config::loadConfig();

        $this->response = new Response();

        $this->db = new Database($this->config);

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
