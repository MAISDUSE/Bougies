<?php
namespace app\controllers;


use app\models\User;
use \core\Controller;


class UsersController extends Controller
{
  public function show($id){
    $user = User::find($id);
    echo $user->login;
  }


  public function loginForm(){
    //test si qqn co
    //affiche le form car non connecté
  }

  public function login(){
    //login le user via les fonction dans Authentification check mail
  }

  public function register()){
//recupère les données utilisateurs puis appele les fonctions de traitement de Authentification


  }


}
