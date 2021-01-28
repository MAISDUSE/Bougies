<?php

namespace app\controllers;

use app\models\Odeur;
use core\Controller;

class OdeursController extends Controller
{
    public function index(){
        var_dump(Odeur::all());
    }
}
