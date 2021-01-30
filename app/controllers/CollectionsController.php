<?php

namespace app\controllers;

use app\models\Collection;
use core\Controller;
use core\Session;

class CollectionsController extends Controller
{
    public function index()
    {
        $this->view->render("collections/index", [
            'collections' => Collection::all()
        ]);
    }

    public function addForm()
    {
        $this->view->render("collections/add");
    }

    public function add()
    {
        $collection = [
            'nom_collection' => $this->request->post('name')
        ];

        if (Collection::unique($collection['nom_collection'], "nom_collection"))
        {
            Collection::create($collection);
            Session::addSuccess("Ajout réussi", "La collection a bien été ajouté.");
            $this->redirect('/collections');
        }
        else
        {
            Session::addError("Ajout impossible", "Cette collection existe déjà");
            Session::setOld(['name' => $collection['nom_collection']]);
            $this->redirect('/collections/add');
        }
    }

    public function show($id)
    {
        $this->view->render("collections/show", [
            'collection' => Collection::findOrFail($id)
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("collections/update", [
            'collection' => Collection::findOrFail($id)
        ]);
    }

    public function update($id)
    {
        $collection = [
            'nom_collection' => $this->request->post('name')
        ];

        Session::addSuccess("Modification réussie", "La Collection a bien été modifié.");

        Collection::update($id, $collection);

        $this->redirect('/collections');

    }

    public function deleteForm($id)
    {
        $this->view->render("collections/delete", [
            'collection' => Collection::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        $collection = Collection::findOrFail($id);

        if (count($collection->bougies()) != 0)
        {
            Session::addError("Suppression impossible", "La collection a encore des bougies à son actif.");
        }
        else
        {

            Collection::delete($id);
            Session::addSuccess("Suppression réussie", "La Collection a bien été supprimé.");
        }

        $this->redirect('/collections');
    }
}
