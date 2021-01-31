<?php

namespace app\controllers;

use app\models\Odeur;
use app\models\Recette;
use core\Controller;
use core\Session;

/**
 * Class OdeursController
 * @package app\controllers
 */
class OdeursController extends Controller
{
    /**
     * Affiche toutes les odeurs
     */
    public function index()
    {
        $this->view->render("odeurs/index",[
            'odeurs' => Odeur::all()
        ]);
    }

    /**
     * Affiche le formulaire de création d'une odeur
     */
    public function addForm()
    {
        $this->view->render("odeurs/add");
    }

    /**
     * Crée une odeur
     */
    public function add()
    {
        $odeur = [
            'nom_odeur' => $this->request->post('name'),
            'statut_odeur' => $this->request->post('statut_odeur')
        ];

        if (Odeur::unique($odeur['nom_odeur'], "nom_odeur"))
        {
            Odeur::create($odeur);
            Session::addSuccess("Ajout réussi", "L'odeur a bien été ajoutée.");
            $this->redirect('/odeurs');
        }
        else
        {
            Session::addError("Ajout impossible", "Cette odeur existe déjà");
            Session::setOld(['name' => $odeur['nom_odeur']]);
            $this->redirect('/odeurs/add');
        }
    }

    /**
     * Affiche les détails d'une odeur
     * @param mixed $id Identifiant de l'odeur
     */
    public function show($id)
    {
        $this->view->render("odeurs/show", [
            'odeur' => Odeur::findOrFail($id)
        ]);
    }

    /**
     * Affiche le formulaire de modification d'une odeur
     * @param mixed $id Identifiant de l'odeur
     */
    public function updateForm($id)
    {
        $this->view->render("odeurs/update", [
            'odeur' => Odeur::findOrFail($id)
        ]);
    }

    /**
     * Modifie une odeur
     * @param mixed $id Identifiant de l'odeur
     */
    public function update($id)
    {
        $odeur = [
            'nom_odeur' => $this->request->post('name'),
            'statut_odeur' => $this->request->post('statut_odeur')
        ];

        Odeur::update($id, $odeur);

        Session::addSuccess("Modification réussie", "L'odeur a bien été modifiée.");

        $this->redirect("/odeurs");
    }

    /**
     * Affiche le formulaire de suppression d'une odeur
     * @param mixed $id Identifiant de l'odeur
     */
    public function deleteForm($id)
    {
        $this->view->render("odeurs/delete", [
            'odeur' => Odeur::findOrFail($id)
        ]);
    }

    /**
     * Supprime une odeur
     * @param mixed $id Identifiant de l'odeur
     */
    public function delete($id)
    {
        $odeur = Odeur::findOrFail($id);

        if (count($odeur->recettes()) != 0)
        {
            Session::addError("Suppression impossible", "L'odeur est encore présente dans des recettes.");
        }
        else
        {
            Odeur::delete($id);
            Session::addSuccess("Suppression réussie", "L'odeur a bien été supprimée.");
        }

        $this->redirect('/odeurs');
    }
}
