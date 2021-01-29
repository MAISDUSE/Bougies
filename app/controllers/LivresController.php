<?php

namespace app\controllers;

use app\models\Livre;
use core\Controller;

class LivresController extends Controller
{
    public function index(){
        var_dump(Livre::all());
    }
}
