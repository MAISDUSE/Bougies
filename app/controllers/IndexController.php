<?php

namespace app\controllers;

use \core\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        echo "IndexController class";
    }
}