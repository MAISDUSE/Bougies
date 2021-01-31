<?php

namespace app\controllers;

use app\models\Livre;
use app\models\Auteur;
use core\Controller;
use core\Session;

/**
 * Class LivresController
 * @package app\controllers
 */
class LivresController extends Controller
{
    /**
     * Affiche tous les livres
     */
    public function index()
    {
        $this->view->render("livres/index",[
            'livres' => Livre::all()
        ]);
    }

    /**
     * Affiche le formulaire de création d'un livre
     */
    public function addForm()
    {
        $this->view->render("livres/add", [
            'auteurs' => Auteur::all(),
        ]);
    }

    /**
     * Crée un livre
     */
    public function add()
    {
        $livre = [
            'titre' => $this->request->post('name'),
            'id_auteur' => $this->request->post('id_auteur')
        ];

        if (Livre::unique($livre['titre'], "titre"))
        {
            Livre::create($livre);
            Session::addSuccess("Ajout réussi", "Le livre a bien été ajouté.");
            $this->redirect('/livres');
        }
        else
        {
            Session::addError("Ajout impossible", "Ce livre existe déjà");
            Session::setOld(['name' => $livre['titre']]);
            $this->redirect('/livres/add');
        }
    }

    /**
     * Affiche les détails d'un livre
     * @param mixed $id Identifiant du livre
     */
    public function show($id)
    {
        $this->view->render("livres/show", [
            'livre' => Livre::findOrFail($id)
        ]);
    }

    /**
     * Affiche le formulaire de modification d'un livre
     * @param mixed $id Identifiant du livre
     */
    public function updateForm($id)
    {
        $this->view->render("livres/update", [
            'livre' => Livre::findOrFail($id),
            'auteurs' => Auteur::all()
        ]);
    }

    /**
     * Modifie un livre
     * @param mixed $id Identifiant du livre
     */
    public function update($id)
    {
        $livre = [
            'titre' => $this->request->post('name'),
            'id_auteur' => $this->request->post('id_auteur')
        ];

        Livre::update($id, $livre);

        Session::addSuccess("Modification réussie", "Le livre a bien été modifié.");

        $this->redirect("/livres");
    }

    /**
     * Affiche le formulaire de suppression d'un livre
     * @param mixed $id Identifiant du livre
     */
    public function deleteForm($id)
    {
        $this->view->render("livres/delete", [
            'livre' => Livre::findOrFail($id)
        ]);
    }

    /**
     * Supprime un livre
     * @param mixed $id Identifiant du livre
     */
    public function delete($id)
    {
        $livre = Livre::findOrFail($id);

        if (count($livre->bougies()) != 0)
        {
            Session::addError("Suppression impossible", "Le livre a encore des bougies.");
        }
        else
        {
            Livre::delete($id);
            Session::addSuccess("Suppression réussie", "Le livre a bien été supprimé.");
        }

        $this->redirect('/livres');
    }
}
