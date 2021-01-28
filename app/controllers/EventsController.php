<?php

namespace app\controllers;

use app\models\Event;
use core\Controller;

class EventsController extends Controller
{
    public function index(){
        var_dump(Event::all());
    }
}
