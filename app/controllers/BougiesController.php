<?php

namespace app\controllers;

use app\models\Bougie;
use app\models\Collection;
use app\models\Livre;
use core\Controller;
use core\Session;

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
        $this->view->render("bougies/add", [
            'livres' => Livre::all(),
            'collections' => Collection::all()
        ]);
    }

    public function add()
    {
        $bougie = [
            'nom_bougie' => $this->request->post('name'),
            'id_livre' => $this->request->post('id_livre'),
            'id_collection' => $this->request->post('id_collection'),
            'statut_bougie' => "neutre"
        ];

        if (Bougie::unique($bougie['nom_bougie'], "nom_bougie"))
        {
            Bougie::create($bougie);
            Session::addSuccess("Ajout réussi", "La bougie a bien été ajoutée.");
            $this->redirect('/bougies');
        }
        else
        {
            Session::addError("Ajout impossible", "Cette bougie existe déjà");
            Session::setOld(['name' => $bougie['nom_bougie']]);
            $this->redirect('/bougies/add');
        }
    }

    public function show($id)
    {
        $this->view->render("bougies/show", [
            'bougie' => Bougie::findOrFail($id)
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("bougies/update", [
            'bougie' => Bougie::findOrFail($id),
            'livres' => Livre::all(),
            'collections' => Collection::all()
        ]);
    }

    public function update($id)
    {
        $bougie = [
            'nom_bougie' => $this->request->post('name'),
            'id_livre' => $this->request->post('id_livre'),
            'id_collection' => $this->request->post('id_collection'),
            'statut_bougie' => $this->request->post('statut_bougie')
        ];

        Bougie::update($id, $bougie);

        Session::addSuccess("Modification réussie", "La bougie a bien été modifiée.");

        $this->redirect("/bougies");
    }

    public function deleteForm($id)
    {
        $this->view->render("bougies/delete", [
            'bougie' => Bougie::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        $bougie = Bougie::findOrFail($id);

        if (count($bougie->recettes()) != 0)
        {
            Session::addError("Suppression impossible", "La bougie a encore des recettes.");
        }
        else
        {
            Bougie::delete($id);
            Session::addSuccess("Suppression réussie", "La bougie a bien été supprimée.");
        }

        $this->redirect('/bougies');
    }
}
