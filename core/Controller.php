<?php

namespace core;

use core\View;

/**
 * Class Controller
 * @package core
 */
abstract class Controller
{
    /**
     * @var \core\View $view instance de View
     */
    public View $view;

    /**
     * @var Response $response Instance de la classe Response de l'application
     */
    public Response $response;

    /**
     * Controller constructor.
     * Crée une instance de vue & récupère l'instande de Response
     */
    public function __construct()
    {
        $this->view = new View();
        $this->response = Application::$app->response;
    }

    public function redirect(string $url)
    {
        $this->response->redirect($url);
    }
}
