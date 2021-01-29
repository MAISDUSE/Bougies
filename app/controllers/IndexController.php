<?php

namespace app\controllers;

use app\models\Auteur;
use app\models\Bougie;
use app\models\Event;
use app\models\Livre;
use \core\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->view->render("index", [
            "nbBougies" => Bougie::count(),
            "nbLivres" => Livre::count(),
            "nbAuteurs" => Auteur::count(),
            "nbEvents" => Event::count()
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
