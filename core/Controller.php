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
     * @var \core\View $view Instance de View
     */
    public View $view;

    /**
     * @var Request $request Instance de Request
     */
    public Request $request;

    /**
     * @var Response $response Instance de la classe Response de l'application
     */
    public Response $response;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->view = new View();
        $this->response = Application::$app->response;
        $this->request = $request;

    }

    /**
     * Redirige vers l'url passée en paramètre
     * @param string $url Url cible
     */
    public function redirect(string $url)
    {
        $this->response->redirect($url);
    }
}
