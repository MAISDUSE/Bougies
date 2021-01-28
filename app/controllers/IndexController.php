<?php

namespace app\controllers;

use app\models\Bougie;
use app\models\Event;
use \core\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $data1 = "Ceci est ma première donnée via render";
        $data2 = [1,2,3,4,5,6,7,8,9];

        $this->view->render("index", [
            "param1" => $data1, //variable simple
            "param2" => $data2 //tableau entier
        ]);

        //return $this->view->display("layout/app.layout.php");
        //ancienne methode desomais on fait tout en un appel de render
    }

    public function contact()
    {
        $this->view->render("contact");
    }

    public function events()
    {
        $this->view->render("layout/app", ["param1" => Event::all(), "param2" => []]);
    }

    public function bougies()
    {
        $this->view->render("bougies/index",[
           'bougies' => Bougie::all()
        ]);
    }

    public function getBougie($bougieid)
    {
        $this->view->render("bougies/show",[
            'bougie' => Bougie::find($bougieid)
        ]);
    }

    public function showEvent($event)
    {
        echo "Event : $event!";
    }
}
