<?php

namespace app\controllers;

use app\models\Bougie;
use app\models\Collection;
use app\models\Livre;
use core\Controller;
use core\Session;

/**
 * Class BougiesController
 * @package app\controllers
 */
class BougiesController extends Controller
{
    /**
     * Affiche toutes les bougies
     */
    public function index()
    {
        $this->view->render("bougies/index",[
            'bougies' => Bougie::all()
        ]);
    }

    /**
     * Affiche le formulaire de création d'une bougie
     */
    public function addForm()
    {
        $this->view->render("bougies/add", [
            'livres' => Livre::all(),
            'collections' => Collection::all()
        ]);
    }

    /**
     * Crée une bougie
     */
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

    /**
     * Affiche les détails une bougie
     * @param mixed $id Identifiant d'une bougie
     */
    public function show($id)
    {
        $this->view->render("bougies/show", [
            'bougie' => Bougie::findOrFail($id)
        ]);
    }

    /**
     * Affiche le formulaire de modification d'une bougie
     * @param mixed $id Identifiant d'une bougie
     */
    public function updateForm($id)
    {
        $this->view->render("bougies/update", [
            'bougie' => Bougie::findOrFail($id),
            'livres' => Livre::all(),
            'collections' => Collection::all()
        ]);
    }

    /**
     * Modifie une bougie
     * @param mixed $id Identifiant d'une bougie
     */
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

    /**
     * Affiche le formulaire de suppression d'une bougie
     * @param mixed $id Identifiant d'une bougie
     */
    public function deleteForm($id)
    {
        $this->view->render("bougies/delete", [
            'bougie' => Bougie::findOrFail($id)
        ]);
    }

    /**
     * Supprime une bougie
     * @param mixed $id Identifiant d'une bougie
     */
    public function delete($id)
    {
        $bougie = Bougie::findOrFail($id);

        if (count($bougie->recettes()) != 0)
        {
            Session::addError("Suppression impossible", "La bougie a encore des recettes.");
        }
        else if (count($bougie->events()) != 0)
        {
            Session::addError("Suppression impossible", "La bougie est toujours associée à un évènement.");
        }
        else
        {
            Bougie::delete($id);
            Session::addSuccess("Suppression réussie", "La bougie a bien été supprimée.");
        }

        $this->redirect('/bougies');
    }
}
