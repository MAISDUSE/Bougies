<?php

namespace app\controllers;

use app\models\User;
use core\Controller;
use core\Session;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        foreach ($users as $user)
        {
            unset($user->pwd);
        }

        $this->view->render("admin/index", [
            'users' => $users
        ]);
    }

    public function updateForm($id)
    {
        $this->view->render("admin/update", [
            'user' => User::findOrFail($id)
        ]);
    }

    public function update($id)
    {
        $user = [
            'login' => $this->request->post('name'),
            'role' => $this->request->post('role')
        ];

        User::update($id, $user);

        Session::addSuccess("Modification réussie", "L'utilisateur a bien été modifié.");

        $this->redirect("/admin");
    }

    public function deleteForm($id)
    {
        $this->view->render("admin/delete", [
            'user' => User::findOrFail($id)
        ]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if($id == $_SESSION['id']){

            Session::addError("Suppression impossible", "Vous ne pouvez pas vous supprimer.");

        }else{

            User::delete($id);
            Session::addSuccess("Suppression réussie", "L'utilisateur a bien été supprimée.");

        }


        $this->redirect('/admin');
    }
}
