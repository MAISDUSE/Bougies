<?php

namespace app\controllers;


use app\models\User;
use \core\Controller;
use \core\Authentication as Auth;


class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        //echo $user->login;
        //$this->view->render("/users/{$id}");
    }


    public function loginForm()
    { //get la page de login
        //test si qqn co si non :
        //affiche le form car non connecté
        //si oui page login apres form

        $this->view->render("/users/login");

    }

    /**
     * Récupère les login et mot de passe en post
     */
    public function login()
    {
        $password = $this->request->post('password');
        $login = $this->request->post('login');

        if ($password && $login)
        {
            $etat = Auth::login($login, $password);

            if ($etat == -1 | $etat == -2)
            {
                $this->redirect("/login");
            }
            else
            {
                $this->redirect("/users");
            }
        }
    }

    public function me()
    {
        if (isset($_SESSION["id"])) {
            $this->view->render("/users/user");
        } else {
            $this->redirect("/login");
        }

    }

    public function register()
    {
        //recupère les données utilisateurs puis appele les fonctions de traitement de Authentification
        $login = $_POST['login'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        //check user avec meme login n'existe pas
        //si exit affiche code erreur dans $etat2 de la vue
        $etat2 = Auth::register($login, $password, $cpassword);


        if ($etat == 1 | $etat == 2) {
            $this->view->render("login", ["etat" => $etat]);
        } else {
            //si register ok
            //session deja set
            $this->view->render("user");
        }
    }


    public function logout()
    {
        Auth::logout();
        $this->redirect("/login");
    }

}
