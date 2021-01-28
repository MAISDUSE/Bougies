<?php


namespace core;

use app\models\User;


class Authentication
{

  public static function logout()
  {
    session_unset();
    session_destroy();
  }

  public static function login($login, $lpassword): int
  {
    $me = Application::$app->db->find("user", "login", $login);
    //var_dump($me);
    if ($me) {
      //compte existe bien
      if (password_verify($lpassword, $me->pwd)) {
        $etat = $me->id;//"Mot de passe correct, connection en cours...";
        $_SESSION['login'] = $me->login;
        $_SESSION['role'] = $me->role;
        $_SESSION['id'] = $me->id;

      } else {
        $etat = -1;//"Mot de passe éronné.";
      }

    } else {
      $etat = -2; //"L'utilisateur ".$login." n'existe pas.";
    }
    return $etat;
  }//la valeur de retour s'affiche sur l'écran soit le login n'existe pas

  //soit le mot de passe n'est pas le bon

  public static function register($login, $password, $cpassword): int
  {
    $etat=-3;
    if ($password == $cpassword) {
      $hashpass = password_hash($password, PASSWORD_DEFAULT);
      $me = Application::$app->db->find("user", "login", $login);
      if ($me == false) { //ce login n'est pas encore utilisé

        $user = [
            'login' => $login,
            'pwd' => $hashpass,
            'role' => 0
        ];
        $me = User::create($user);

        session_unset();
        $etat = $me->id;//"Le compte a été créé";
        $_SESSION['login'] = $login;
        $_SESSION['role'] = $me->role;
        $_SESSION['id'] = $etat;


      } else {
        $etat2 = -1;//"Cet email est déja utilisé.";
      }
    } else {
      $etat2 = -2;//"Mot de passe différents.";
    }
    return $etat;

  }


}
