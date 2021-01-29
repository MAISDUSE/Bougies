<?php

use app\controllers\BougiesController;
use app\controllers\IndexController;
use app\controllers\UsersController;
use app\controllers\AuteursController;
use app\controllers\CollectionsController;
use app\controllers\EventsController;
use app\controllers\LivresController;
use app\controllers\RecettesController;

use app\controllers\AdminController;

use core\Route;


/* Définition des routes utilisateurs
    Syntaxe : Route::[get|post](uri, callback);
    callback :
        Controller (méthode par défaut appelée [index])
        [Controller, method]
        fonction anonyme : function () {}

    Route::get('/test', function () {
        echo "Test function !<br>";
    });
*/


Route::get('/', IndexController::class);


//users
Route::get('/user', [UsersController::class, 'show']);
Route::get('/users/{id}', [UsersController::class, 'show']);

Route::get('/login', [UsersController::class, 'loginForm']);
Route::get('/register', [UsersController::class, 'registerForm']);

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);

Route::get('/logout', [UsersController::class, 'logout']);


//AuteursController
Route::get('/auteurs', AuteursController::class);

Route::get('/auteurs/add', [AuteursController::class, 'addForm']);
Route::post('/auteurs/add', [AuteursController::class, 'add']);

Route::get('/auteurs/{id}/update', [AuteursController::class, 'updateForm']);
Route::post('/auteurs/{id}/update', [AuteursController::class, 'update']);

Route::get('/auteurs/{id}/delete', [AuteursController::class, 'deleteForm']);
Route::post('/auteurs/{id}/delete', [AuteursController::class, 'delete']);


//BougiesController
Route::get('/bougies',BougiesController::class);

Route::get('/bougies/{id}', [BougiesController::class, 'show']);

Route::get('/bougies/{id}/update', [BougiesController::class, 'updateForm']);
Route::post('/bougies/{id}/update', [BougiesController::class, 'update']);

Route::get('/bougies/{id}/delete', [BougiesController::class, 'deleteForm']);
Route::post('/bougies/{id}/delete', [BougiesController::class, 'delete']);


//CollectionsController
Route::get('/collections', CollectionsController::class);

Route::get('/collections/add', [CollectionsController::class, 'addForm']);
Route::post('/collections/add', [CollectionsController::class, 'add']);

Route::get('/collections/{id}/update', [CollectionsController::class, 'updateForm']);
Route::post('/collections/{id}/update', [CollectionsController::class, 'update']);

Route::get('/collections/{id}/delete', [CollectionsController::class, 'deleteForm']);
Route::post('/collections/{id}/delete', [CollectionsController::class, 'delete']);


//EventsController
Route::get('/events', EventsController::class);
Route::get('/events/{id}', [EventsController::class, 'show']);

//LivresController
Route::get('/livres', LivresController::class);

//OdeursController
Route::get('/odeurs', AdminController::class);

//RecettesController
Route::get('/recettes', RecettesController::class);



//AdminController
Route::get('/admin', AdminController::class);