<?php

namespace core;

use core\View;

abstract class Controller
{
    public View $view;
    public function __construct()
    {
        $this->view = new View();
    }
}
