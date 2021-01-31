<?php

namespace app\controllers;

use app\models\Collection;
use core\Controller;
use core\Session;

/**
 * Class CollectionsController
 * @package app\controllers
 */
class CollectionsController extends Controller
{
    /**
     * Affiche toutes les collections
     */
    public function index()
    {
        $this->view->render("collections/index", [
            'collections' => Collection::all()
        ]);
    }

    /**
     * Affiche le formulaire de création d'une collection
     */
    public function addForm()
    {
        $this->view->render("collections/add");
    }

    /**
     * Crée une collection
     */
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

    /**
     * Affiche les détails d'une collection
     * @param mixed $id Identifiant de la collection
     */
    public function show($id)
    {
        $this->view->render("collections/show", [
            'collection' => Collection::findOrFail($id)
        ]);
    }


    /**
     * Affiche le formulaire de modification d'une collection
     * @param mixed $id Identifiant de la collection
     */
    public function updateForm($id)
    {
        $this->view->render("collections/update", [
            'collection' => Collection::findOrFail($id)
        ]);
    }

    /**
     * Modifie une collection
     * @param mixed $id Identifiant de la collection
     */
    public function update($id)
    {
        $collection = [
            'nom_collection' => $this->request->post('name')
        ];

        Session::addSuccess("Modification réussie", "La Collection a bien été modifié.");

        Collection::update($id, $collection);

        $this->redirect('/collections');

    }

    /**
     * Affiche le formulaire de suppression d'une collection
     * @param mixed $id Identifiant de l'auteur
     */
    public function deleteForm($id)
    {
        $this->view->render("collections/delete", [
            'collection' => Collection::findOrFail($id)
        ]);
    }

    /**
     * Supprime une collection
     * @param mixed $id Identifiant de la collection
     */
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
