<?php
namespace app\controllers;


use app\models\User;
use \core\Controller;
use \core\Authentication;


class UsersController extends Controller
{
  public function show($id){
    $user = User::find($id);
    //echo $user->login;
    //$this->view->render("/users/{$id}");
  }


  public function loginForm(){ //get la page de login
    //test si qqn co si non :
    //affiche le form car non connecté
    //si oui page login apres form

    $this->view->render("/users/login");

  }

  public function login(){ //form post
    //login le user via les fonction dans Authentification check mail
    //recup params du post
    //appelle login de Authentication qui return un code d'erreur ou sucess

    $password = $_POST['lpassword'];
    $login = $_POST['login'];
    //var_dump($login);

    if($password && $login ){
      $etat = Authentication::login($login,$password);

      //if login success -> la session est set
      //$etat -> switch re-login ou loged
      if($etat == -1 | $etat == -2){
        $this->redirect("/login"); //plus tard add etat
      }else{
        //display me after login
        //display user.php avec $etat contient le user id
        //recup id pour display me A FAIRE

        $this->redirect("/users");
      }
    }



  }

  public function me(){
    if(isset($_SESSION["id"])){
      $this->view->render("/users/user");
    }else{
        $this->redirect("/login");
    }

  }

  public function register(){
    //recupère les données utilisateurs puis appele les fonctions de traitement de Authentification
    $login = $_POST['login'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    //check user avec meme login n'existe pas
    //si exit affiche code erreur dans $etat2 de la vue
    $etat2 =  Authentication::register($login,$password, $cpassword);


    if($etat ==1 | $etat ==2){
      $this->view->render("login",["etat"=>$etat]);
    }else{
      //si register ok
      //session deja set
      $this->view->render("user");
    }
  }



  public function logout(){
    Authentication::deconnexion();
    $this->redirect("/login");
  }

}
