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


  public function login($id, $pass){

  }

  public function register($login, $pass){

    
  }


}
