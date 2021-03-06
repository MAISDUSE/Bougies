<?php

namespace app\controllers;


use app\models\User;
use \core\Controller;
use \core\Authentication as Auth;
use core\Session;

/**
 * Class UsersController
 * @package app\controllers
 */
class UsersController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function loginForm()
    {
        if(isset($_SESSION['login']))
        {
            Session::addSuccess('Connecté', 'Bon retour parmi nous!');
            $this->redirect('/');
        }
        $this->view->render("users/login");
    }

    /**
     * Connecte l'utilisateur
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
                Session::addError('Identifiants incorrects','Vos identifiants sont incorrects, merci de réessayer');
                $this->redirect("/login");
            }
            else
            {
                Session::addSuccess('Connecté', 'Bon retour parmi nous!');
                $this->redirect("/user");
            }
        }
    }

    /**
     * Affiche les détails d'un utilisateur
     * @param mixed $id Identifiant d'un utiliateur (valeur par défaut : $_SESSION['id'])
     */
    public function show($id = false)
    {
        $user = false;

        if ($id === false)
        {
            if (!isset($_SESSION['id'])) $this->redirect('/login');
            $user =  User::find($_SESSION['id']);
        }
        else
        {
            if (Auth::can(Auth::PERMISSIONS["admin"]))
            {
                $user = User::find($id);
            }
            else
            {
                $this->view->show404();
            }
        }

        //if ($user === false) $this->redirect('/login');

        $this->view->render("users/show", [
            'user' => $user
        ]);
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function registerForm()
    {
        $this->view->render("users/register");
    }

    /**
     * Incrit un utilisateur, par défaut, un utilisateur pourra seulement ajouter des éléments
     */
    public function register()
    {
        //recupère les données utilisateurs puis appele les fonctions de traitement de Authentification
        $login = $this->request->post('login');
        $password = $this->request->post('password');
        $cpassword = $this->request->post('cpassword');

        //check user avec meme login n'existe pas
        //si exit affiche code erreur dans $etat2 de la vue
        $etat = Auth::register($login, $password, $cpassword);

        if ($etat > 0)
        {
            //si register ok
            //session deja set
            Session::addSuccess('Inscription réussie', 'Bienvenue parmi nous !');
            $this->redirect("/user");
        }
        else if ($etat == -1)
        {
            Session::addError('Erreur', 'Cet identifiant est déjà pris !');
            Session::setOld(['login' => $login]);
            $this->redirect('/register');
        }
        else if ($etat == -2)
        {
            Session::addError('Erreur', 'Vos mots de passe ne correspondent pas.');
            Session::setOld(['login' => $login]);
            $this->redirect('/register');
        }
        else
        {
            Session::addError('Erreur', 'Une erreur est survenue !');
            $this->redirect('/register');
        }
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout()
    {
        Auth::logout();
        session_start();
        Session::addSuccess('Déconnecté', 'Au revoir !');
        $this->redirect("/login");
    }

}
