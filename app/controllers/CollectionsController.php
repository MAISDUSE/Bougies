<?php

namespace app\controllers;

use app\models\Collection;
use core\Controller;

class CollectionsController extends Controller
{
    public function index(){
        var_dump(Collection::all());
    }
}
