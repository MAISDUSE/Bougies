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
     * Controller constructor. crée une instance de View
     */
    public function __construct()
    {
        $this->view = new View();
    }
}
