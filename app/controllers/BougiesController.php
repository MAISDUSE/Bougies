<?php

namespace app\controllers;

use app\models\Bougie;
use core\Controller;

class BougiesController extends Controller
{

    public function index()
    {
        $this->view->render("bougies/index",[
            'bougies' => Bougie::all()
        ]);
    }

    public function addForm()
    {

    }

    public function add()
    {
        $bougie = [
            'nom_bougie' => "test ddddzad",
            'id_livre' => 1,
            'id_collection' => 1
        ];

        $inserted = Bougie::create($bougie);

        $this->view->render("bougies/show", [
            'bougie' => $inserted
        ]);
    }

    public function show($id)
    {
        $this->view->render("bougies/show", [
            'bougie' => Bougie::find($id)
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("bougies/edit", [
            'bougie' => Bougie::find($id)
        ]);
    }

    public function update($id)
    {
        $bougie = [
            'nom_bougie' => "Bougie de malade mental"
        ];

        Bougie::update($id, $bougie);

        $this->redirect("/bougies/$id");
    }

    public function deleteForm($id)
    {
        $this->view->render("bougies/delete", [
            'bougie' => Bougie::find($id)
        ]);
    }

    public function delete($id)
    {
        Bougie::delete($id);

        $this->redirect("/bougies");
    }
}