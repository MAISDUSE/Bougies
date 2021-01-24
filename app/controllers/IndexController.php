<?php

namespace app\controllers;

use app\models\Event;
use \core\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $data1 = "Ceci est ma première donnée via render";
        $data2 = [1,2,3,4,5,6,7,8,9];

        return $this->view->render("layout/app.layout.php", [
            "param1" => $data1, //variable simple
            "param2" => $data2 //tableau entier
        ]);


        //return $this->view->display("layout/app.layout.php");
        //ancienne methode desomais on fait tout en un appel de render
    }

    public function contact()
    {
        echo "contact";
    }

    public function showUser(User $user)
    {
        \Bougie::all();
    }

    public function events()
    {
        $this->view->render("layout/app.layout.php", ["param1" => Event::all(), "param2" => []]);
    }
}
