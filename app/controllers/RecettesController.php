<?php

namespace app\controllers;

use app\models\Recette;
use core\Controller;

class RecettesController extends Controller
{
    public function index(){
        var_dump(Recette::all());
    }
}
