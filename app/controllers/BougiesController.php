<?php

namespace app\controllers;

use app\models\Bougie;
use core\Controller;

class BougiesController extends Controller
{
    public function testInsert()
    {
        $bougie = [
            'nom_bougie' => "test nom",
            'id_livre' => 1,
            'id_collection' => 1
        ];

        $inserted = Bougie::create($bougie);

        $this->view->render("bougies/show", [
            'bougie' => $inserted
        ]);
    }

    public function delete($id)
    {
        $this->view->render("bougies/show", [
            'bougie' => Bougie::delete($id)
        ]);
    }
}