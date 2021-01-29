<?php

namespace app\controllers;

use app\models\User;
use core\Controller;

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
}
