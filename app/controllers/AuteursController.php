<?php

namespace app\controllers;

use app\models\Auteur;
use core\Controller;

class AuteursController extends Controller
{
    //get page affiche les Auteurs
    public function index(){
        //var_dump(Auteur::all());
        $auteurs = Auteur::all();
        $this->view->render("/auteurs/index", [
            'auteurs' => $auteurs
        ]);
    }
    ///////////////////////////////////////////////////////////////
    //form add auteur
    //get form et post
    public function add(){ //post
        //chercher if pas de duplicata here then
        $nom = $this->request->post('nom');
        $auteur = [
            'nom_auteur' => $nom
        ];
        Auteur::create($auteur);
        //auteur ajouté on retourn sur l'affichage de tous les auteurs
        $this->redirect('/auteurs');
    }

    public function addForm(){ //get
        $this->view->render("/auteurs/add");
    }
    ////////////////////////////////////////////////////////////////
    //form edit un auteur
    //get form et post
    public function updateForm($id){ //get
        $auteur = Auteur::find($id);
        $this->view->render("/auteurs/update", [
            'auteur' => $auteur
        ]);
    }

    public function update($id)
    { //post
        $auteur = [
            'nom_auteur' => $this->request->post('newName')
        ];
        Auteur::update($id, $auteur);
        //auteur edité on retourne sur l'affichage de tous les auteurs
        $this->redirect('/auteurs');

    }

    //////////////////////////////////////////////////////////////
    //form supp un auteur
    //get form et post
    public function deleteForm($id)
    { //get
        $auteur = Auteur::find($id);
        $this->view->render("/auteurs/delete", [
            'auteur' => $auteur
        ]);
    }
    public function delete($id){ //post
        Auteur::delete($id);
        //auteur supprimé on retourne sur l'affichage de tous les auteurs
        $this->redirect('/auteurs');

    }
}
