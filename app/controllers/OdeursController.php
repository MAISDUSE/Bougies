<?php

namespace app\controllers;

use app\models\Odeur;
use app\models\Recette;
use core\Controller;
use core\Session;

class OdeursController extends Controller
{
    public function index()
    {
        $this->view->render("odeurs/index",[
            'odeurs' => Odeur::all()
        ]);
    }

    public function addForm()
    {
        $this->view->render("odeurs/add");
    }

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

    public function show($id)
    {
        $this->view->render("odeurs/show", [
            'odeur' => Odeur::findOrFail($id)
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("odeurs/update", [
            'odeur' => Odeur::findOrFail($id)
        ]);
    }

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

    public function deleteForm($id)
    {
        $this->view->render("odeurs/delete", [
            'odeur' => Odeur::findOrFail($id)
        ]);
    }

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
