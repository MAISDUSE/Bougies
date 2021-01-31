<?php

namespace app\controllers;

use app\models\Recette;
use app\models\Bougie;
use app\models\Odeur;
use core\Controller;
use core\Session;

class RecettesController extends Controller
{

    public function index()
    {
        $this->view->render("recettes/index",[
            'recettes' => Recette::all()
        ]);
    }

    public function addForm()
    {
        $this->view->render("recettes/add", [
            'bougies' => Bougie::all(),
            'odeurs' => Odeur::all()
        ]);
    }

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

    public function show($id)
    {
        $this->view->render("recettes/show", [
            'recette' => Recette::findOrFail($id)
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("recettes/update", [
            'recette' => Recette::findOrFail($id),
            'bougies' => Bougie::all(),
            'odeurs' => Odeur::all()
        ]);
    }

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

    public function deleteForm($id)
    {
        $this->view->render("recettes/delete", [
            'recette' => Recette::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        $recette = Recette::findOrFail($id);

            Recette::delete($id);
            Session::addSuccess("Suppression réussie", "La recette a bien été supprimée.");


        $this->redirect('/recettes');
    }
}
