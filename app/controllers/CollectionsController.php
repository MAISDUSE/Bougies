<?php

namespace app\controllers;

use app\models\Collection;
use core\Controller;

class CollectionsController extends Controller
{
    //get page affiche les collections
    public function index(){
        //var_dump(collection::all());
        $collections = Collection::all();
        $this->view->render("/collections/index", [
            'collections' => $collections
        ]);
    }
    ///////////////////////////////////////////////////////////////
    //form add collection
    //get form et post
    public function add(){ //post
        //chercher if pas de duplicata here then
        $nom = $this->request->post('nom');
        $collection = [
            'nom_collection' => $nom
        ];
        Collection::create($collection);
        //collection ajoutée on retourn sur l'affichage de toutes les collections
        $this->redirect('/collections');
    }

    public function addForm(){ //get
        $this->view->render("/collections/add");
    }
    ////////////////////////////////////////////////////////////////
    //form edit une collection
    //get form et post
    public function updateForm($id){ //get
        $collection = Collection::find($id);
        $this->view->render("/collections/update", [
            'collection' => $collection
        ]);
    }

    public function update($id)
    { //post
        $collection = [
            'nom_collection' => $this->request->post('newName')
        ];
        Collection::update($id, $collection);
        //collection editée on retourne sur l'affichage de tous les collections
        $this->redirect('/collections');

    }

    //////////////////////////////////////////////////////////////
    //form supp une collection
    //get form et post
    public function deleteForm($id)
    { //get
        $collection = Collection::find($id);
        $this->view->render("/collections/delete", [
            'collection' => $collection
        ]);
    }
    public function delete($id){ //post
        Collection::delete($id);
        //Collection supprimée on retourne sur l'affichage de tous les collections
        $this->redirect('/collections');

    }
}
