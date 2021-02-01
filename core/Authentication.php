<?php


namespace core;

use app\models\User;

/**
 * Class Authentication
 * @package core
 */
class Authentication
{
    /**
     * Constante => tableau de permissions
     */
    public const PERMISSIONS = [
        "add" => 1,
        "edit" => 2,
        "delete" => 3,
        "admin" => 10
    ];

    /**
     * Constante => Desciption des permissions
     */
    public const PERM_DESC = [
        "add" => "Ajouter des éléments",
        "edit" => "Editer des éléments",
        "delete" => "Supprimer des éléments",
        "admin" => "Gérer les utilisateurs"
    ];

    /**
     * L'utilisateur peut-il executer l'action ?
     * @param mixed $minPerm Permission de l'action à effectuer
     * @param int $idUser Identifiant de l'utilisateur
     * @return bool true si l'utilisateur a la permission, false sinon
     */
    public static function can($minPerm, int $idUser = 0): bool
    {
        if (is_string($minPerm))
        {
            $minPerm = self::PERMISSIONS[$minPerm];
        }

        if (!isset($_SESSION['id'])) return false;

        $can = false;
        $role = $idUser;

        if ($role === 0)
        {
            if (User::find($_SESSION['id'])->role >= $minPerm) $can = true;
        }
        else
        {
            $role = User::find($role)->role;
            if ($role >= $minPerm) $can = true;
        }

        return $can;
    }

    /**
     * Déconnecte l'utilisateur => vide la session et la détruit
     */
    public static function logout()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Connecte l'utilisateur
     * @param string $login Identifiant de l'utilisateur
     * @param string $lpassword Mot de passe de l'utilisateur
     * @return int Code de retour etat < 0 -> connexion échouée, réussie sinon
     */
    public static function login(string $login, string $lpassword): int
    {
        $me = User::where("login", $login)[0];
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
    }

    /**
     * Inscrit un nouvel utilisateur
     * @param string $login Identifiant de l'utilisateur
     * @param string $password Mot de passe
     * @param string $cpassword Confirmation de mot de passe
     * @return int Code de retour etat < 0 -> inscription échouée, réussie sinon
     */
    public static function register(string $login, string $password, string $cpassword): int
    {
        $etat = -3;
        if ($password == $cpassword) {
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            $me = User::unique($login, "login");
            if ($me === true) { //ce login n'est pas encore utilisé

                $user = [
                    'login' => $login,
                    'pwd' => $hashpass,
                    'role' => 1
                ];
                $me = User::create($user);

                session_unset();
                $etat = $me->id;//"Le compte a été créé";
                $_SESSION['login'] = $login;
                $_SESSION['role'] = $me->role;
                $_SESSION['id'] = $etat;


            } else {
                $etat = -1;//"Cet email est déja utilisé.";
            }
        } else {
            $etat = -2;//"Mot de passe différents.";
        }

        return $etat;

    }
}
