<?php

namespace app\controllers;

use \core\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $data = [];
        /*return $this->view->view("layout/app.layout.php", [
            "param1" => $data
        ]);*/

        return $this->view->display("layout/app.layout.php");
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
        $this->view->render("events.layout.php", ["events" => Event::all()]);
    }
}
