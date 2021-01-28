<?php

namespace app\controllers;

use app\models\Auteur;
use core\Controller;

class AuteursController extends Controller
{
    public function index(){
        var_dump(Auteur::all());
    }
}
