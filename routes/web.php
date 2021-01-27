<?php

use app\controllers\BougiesController;
use app\controllers\IndexController;
use app\controllers\UsersController;
use core\Route;


/* Définition des routes utilisateurs
    Syntaxe : Route::[get|post](uri, callback);
    callback :
        Controller (méthode par défaut appelée [index])
        [Controller, method]
        fonction anonyme : function () {}
*/


Route::get('/', IndexController::class);

Route::get('/test', function () {
    echo "Test function !<br>";
});


Route::get('/contact', [IndexController::class, 'contact']);
Route::post('/contact', [IndexController::class, 'sendMail']);

//users
Route::get('/users/{id}', [UsersController::class, 'show']);
Route::post('/login', [UsersController::class, 'login']);
Route::get('/login', [UsersController::class, 'loginForm']);
Route::post('/register', [UsersController::class, 'register']);
Route::get('/register', [UsersController::class, 'registerForm']);
Route::get('/users', [UsersController::class, 'me']);
Route::post('/logout', [UsersController::class, 'logout']);

Route::get('/logout', function() {
   session_unset();
   session_destroy();
});


Route::get('/events/{id}', [IndexController::class, 'showEvent']);

Route::get('/events', [IndexController::class, 'events']);

Route::get('/bougies', [IndexController::class, 'bougies']);
Route::get('/bougies/{id}', [IndexController::class, 'getBougie']);
Route::get('/bougies/{id}/delete', [BougiesController::class, 'delete']);
Route::get('/bougies/{id}/update', [BougiesController::class, 'update']);


Route::get('/bougies/testInsert', [BougiesController::class, 'testInsert']);
