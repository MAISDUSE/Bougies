<?php

namespace app\controllers;

use app\models\Auteur;
use core\Controller;
use core\Session;

class AuteursController extends Controller
{
    public function index()
    {
        $this->view->render("auteurs/index", [
            'auteurs' => Auteur::all()
        ]);
    }

    public function addForm()
    {
        $this->view->render("auteurs/add");
    }

    public function add()
    {
        $auteur = [
            'nom_auteur' => $this->request->post('name')
        ];

        if (Auteur::unique($auteur['nom_auteur'], "nom_auteur"))
        {
            Auteur::create($auteur);
            Session::addSuccess("Ajout réussi", "L\'auteur a bien été ajouté.");
            $this->redirect('/auteurs');
        }
        else
        {
            Session::addError("Ajout impossible", "Cet auteur existe déjà");
            Session::setOld(['name' => $auteur['nom_auteur']]);
            $this->redirect('/auteurs/add');
        }
    }

    public function show($id)
    {
        $this->view->render("auteurs/show", [
            'auteur' => Auteur::findOrFail($id)
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("auteurs/update", [
            'auteur' => Auteur::findOrFail($id)
        ]);
    }

    public function update($id)
    {
        $auteur = [
            'nom_auteur' => $this->request->post('name')
        ];

        Session::addSuccess("Modification réussie", "L\'auteur a bien été modifié.");

        Auteur::update($id, $auteur);

        $this->redirect('/auteurs');

    }

    public function deleteForm($id)
    {
        $this->view->render("auteurs/delete", [
            'auteur' => Auteur::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        $auteur = Auteur::findOrFail($id);

        if (count($auteur->livres()) != 0)
        {
            Session::addError("Suppression impossible", "L\'auteur a encore des livres publiés à son actif.");
        }
        else
        {
            Auteur::delete($id);
            Session::addSuccess("Suppression réussie", "L\'auteur a bien été supprimé.");
        }

        $this->redirect('/auteurs');
    }
}
