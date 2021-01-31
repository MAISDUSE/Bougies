<?php

namespace app\controllers;

use app\models\Recette;
use app\models\Bougie;
use app\models\Odeur;
use core\Controller;
use core\Session;

/**
 * Class RecettesController
 * @package app\controllers
 */
class RecettesController extends Controller
{
    /**
     * Affiche toutes les recettes
     */
    public function index()
    {
        $this->view->render("recettes/index",[
            'recettes' => Recette::all()
        ]);
    }

    /**
     * Affiche le formulaire de création d'une recette
     */
    public function addForm()
    {
        $this->view->render("recettes/add", [
            'bougies' => Bougie::all(),
            'odeurs' => Odeur::all()
        ]);
    }

    /**
     * Crée une recette
     */
    public function add()
    {
        $recette = [
            'id_bougie' => $this->request->post('id_bougie'),
            'id_odeur' => $this->request->post('id_odeur'),
            'quantite' => $this->request->post('quantite')
        ];
        //on suppose qu'il y a une infinité de recettes toutes différentes
/*
        if (Recette::unique($recette['nom_recette'], "nom_recette"))
        {
*/
            Recette::create($recette);
            Session::addSuccess("Ajout réussi", "La recette a bien été ajoutée.");
            $this->redirect('/recettes');
/*
        }
        else
        {

            Session::addError("Ajout impossible", "Cette recette existe déjà");
            Session::setOld(['name' => $recette['nom_recette']]);
            $this->redirect('/recettes/add');
        }
*/
    }

    /**
     * Affiche les détails d'une recette
     * @param mixed $id Identifiant de la recette
     */
    public function show($id)
    {
        $this->view->render("recettes/show", [
            'recette' => Recette::findOrFail($id)
        ]);
    }

    /**
     * Affiche le formulaire de modification d'une recette
     * @param mixed $id Identifiant de la recette
     */
    public function updateForm($id)
    {
        $this->view->render("recettes/update", [
            'recette' => Recette::findOrFail($id),
            'bougies' => Bougie::all(),
            'odeurs' => Odeur::all()
        ]);
    }

    /**
     * Modifie une recette
     * @param mixed $id Identifiant de la recette
     */
    public function update($id)
    {
        $recette = [
            'id_bougie' => $this->request->post('id_bougie'),
            'id_odeur' => $this->request->post('id_odeur'),
            'quantite' => $this->request->post('quantite')
        ];

        Recette::update($id, $recette);

        Session::addSuccess("Modification réussie", "La recette a bien été modifiée.");

        $this->redirect("/recettes");
    }

    /**
     * Affiche le formulaire de suppression d'une recette
     * @param mixed $id Identifiant de la recette
     */
    public function deleteForm($id)
    {
        $this->view->render("recettes/delete", [
            'recette' => Recette::findOrFail($id)
        ]);
    }

    /**
     * Supprime une recette
     * @param mixed $id Identifiant de la recette
     */
    public function delete($id)
    {
        $recette = Recette::findOrFail($id);

            Recette::delete($id);
            Session::addSuccess("Suppression réussie", "La recette a bien été supprimée.");


        $this->redirect('/recettes');
    }
}
