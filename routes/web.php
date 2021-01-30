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

Route::get('/auteurs/add', [AuteursController::class, 'addForm'])->perm("add");
Route::post('/auteurs/add', [AuteursController::class, 'add'])->perm("add");

Route::get('/auteurs/{id}', [AuteursController::class, 'show']);

Route::get('/auteurs/{id}/update', [AuteursController::class, 'updateForm'])->perm("edit");
Route::post('/auteurs/{id}/update', [AuteursController::class, 'update'])->perm("edit");

Route::get('/auteurs/{id}/delete', [AuteursController::class, 'deleteForm'])->perm("delete");
Route::post('/auteurs/{id}/delete', [AuteursController::class, 'delete'])->perm("delete");


//BougiesController
Route::get('/bougies',BougiesController::class);

Route::get('/bougies/add', [BougiesController::class, 'addForm'])->perm("add");
Route::post('/bougies/add', [BougiesController::class, 'add'])->perm("add");

Route::get('/bougies/{id}', [BougiesController::class, 'show']);

Route::get('/bougies/{id}/update', [BougiesController::class, 'updateForm'])->perm("edit");
Route::post('/bougies/{id}/update', [BougiesController::class, 'update'])->perm("edit");

Route::get('/bougies/{id}/delete', [BougiesController::class, 'deleteForm'])->perm("delete");
Route::post('/bougies/{id}/delete', [BougiesController::class, 'delete'])->perm("delete");


//CollectionsController
Route::get('/collections', CollectionsController::class);

Route::get('/collections/add', [CollectionsController::class, 'addForm'])->perm("add");
Route::post('/collections/add', [CollectionsController::class, 'add'])->perm("add");

Route::get('/collections/{id}', [CollectionsController::class, 'show']);

Route::get('/collections/{id}/update', [CollectionsController::class, 'updateForm'])->perm("edit");
Route::post('/collections/{id}/update', [CollectionsController::class, 'update'])->perm("edit");

Route::get('/collections/{id}/delete', [CollectionsController::class, 'deleteForm'])->perm("delete");
Route::post('/collections/{id}/delete', [CollectionsController::class, 'delete'])->perm("delete");


//EventsController
Route::get('/events', EventsController::class);
Route::get('/events/{id}', [EventsController::class, 'show']);

//LivresController
Route::get('/livres', LivresController::class);

Route::get('/livres/add', [LivresController::class, 'addForm'])->perm("add");
Route::post('/livres/add', [LivresController::class, 'add'])->perm("add");

Route::get('/livres/{id}', [LivresController::class, 'show']);

Route::get('/livres/{id}/update', [LivresController::class, 'updateForm'])->perm("edit");
Route::post('/livres/{id}/update', [LivresController::class, 'update'])->perm("edit");

Route::get('/livres/{id}/delete', [LivresController::class, 'deleteForm'])->perm("delete");
Route::post('/livres/{id}/delete', [LivresController::class, 'delete'])->perm("delete");


//OdeursController
Route::get('/odeurs', AdminController::class);

//RecettesController
Route::get('/recettes', RecettesController::class);



//AdminController
Route::get('/admin', AdminController::class)->perm("admin");

Route::get('/admin/{id}/update', [AdminController::class, 'updateForm'])->perm("admin");
Route::post('/admin/{id}/update', [AdminController::class, 'update'])->perm("admin");

Route::get('/admin/{id}/delete', [AdminController::class, 'deleteForm'])->perm("admin");
Route::post('/admin/{id}/delete', [AdminController::class, 'delete'])->perm("admin");
