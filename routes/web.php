<?php

use core\Route;

use app\controllers\BougiesController;
use app\controllers\IndexController;
use app\controllers\UsersController;
use app\controllers\AuteursController;
use app\controllers\CollectionsController;
use app\controllers\EventsController;
use app\controllers\LivresController;
use app\controllers\RecettesController;
use app\controllers\OdeursController;

use app\controllers\AdminController;



/* Définition des routes utilisateurs
    Syntaxe : Route::[get|post](uri, callback);
    callback :
        Controller (méthode par défaut appelée [index])
        [Controller, method]
        fonction anonyme : function () {}

    Route::get('/test', function () {
        echo "Test function !<br>";
    });
    Route::post('/example', ExampleController::class);
    Route::get('/example', [ExampleController::class, 'method']);
*/

Route::get('/', IndexController::class);


// ======
// Routes utilisateur
// ======
Route::get('/user', [UsersController::class, 'show']);
Route::get('/users/{id}', [UsersController::class, 'show']);

Route::get('/login', [UsersController::class, 'loginForm']);
Route::get('/register', [UsersController::class, 'registerForm']);

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);

Route::get('/logout', [UsersController::class, 'logout']);


// ======
// Routes auteurs
// ======
Route::get('/auteurs', AuteursController::class);

Route::get('/auteurs/add', [AuteursController::class, 'addForm'])->perm("add");
Route::post('/auteurs/add', [AuteursController::class, 'add'])->perm("add");

Route::get('/auteurs/{id}', [AuteursController::class, 'show']);

Route::get('/auteurs/{id}/update', [AuteursController::class, 'updateForm'])->perm("edit");
Route::post('/auteurs/{id}/update', [AuteursController::class, 'update'])->perm("edit");

Route::get('/auteurs/{id}/delete', [AuteursController::class, 'deleteForm'])->perm("delete");
Route::post('/auteurs/{id}/delete', [AuteursController::class, 'delete'])->perm("delete");


// ======
// Routes bougies
// ======
Route::get('/bougies',BougiesController::class);

Route::get('/bougies/add', [BougiesController::class, 'addForm'])->perm("add");
Route::post('/bougies/add', [BougiesController::class, 'add'])->perm("add");

Route::get('/bougies/{id}', [BougiesController::class, 'show']);

Route::get('/bougies/{id}/update', [BougiesController::class, 'updateForm'])->perm("edit");
Route::post('/bougies/{id}/update', [BougiesController::class, 'update'])->perm("edit");

Route::get('/bougies/{id}/delete', [BougiesController::class, 'deleteForm'])->perm("delete");
Route::post('/bougies/{id}/delete', [BougiesController::class, 'delete'])->perm("delete");


// ======
// Routes collection
// ======
Route::get('/collections', CollectionsController::class);

Route::get('/collections/add', [CollectionsController::class, 'addForm'])->perm("add");
Route::post('/collections/add', [CollectionsController::class, 'add'])->perm("add");

Route::get('/collections/{id}', [CollectionsController::class, 'show']);

Route::get('/collections/{id}/update', [CollectionsController::class, 'updateForm'])->perm("edit");
Route::post('/collections/{id}/update', [CollectionsController::class, 'update'])->perm("edit");

Route::get('/collections/{id}/delete', [CollectionsController::class, 'deleteForm'])->perm("delete");
Route::post('/collections/{id}/delete', [CollectionsController::class, 'delete'])->perm("delete");


// ======
// Routes events
// ======
Route::get('/events', EventsController::class);

Route::get('/events/{id}', [EventsController::class, 'show']);

Route::get('/events/add', [EventsController::class, 'addForm'])->perm("add");
Route::post('/events/add', [EventsController::class, 'add'])->perm("add");

Route::get('/events/{id}/assocbougie', [EventsController::class, 'assocBougieForm'])->perm("add");
Route::post('/events/{id}/assocbougie', [EventsController::class, 'assocBougie'])->perm("add");

Route::get('/events/{idEvent}/assocbougie/{idBougie}/delete', [EventsController::class, 'deleteAssocBougieForm'])->perm("delete");
Route::post('/events/{idevent}/assocbougie/{idBougie}/delete', [EventsController::class, 'deleteAssocBougie'])->perm("delete");


Route::get('/events/{id}/update', [EventsController::class, 'updateForm'])->perm("edit");
Route::post('/events/{id}/update', [EventsController::class, 'update'])->perm("edit");

Route::get('/events/{id}/delete', [EventsController::class, 'deleteForm'])->perm("delete");
Route::post('/events/{id}/delete', [EventsController::class, 'delete'])->perm("delete");


// ======
// Routes livres
// ======
Route::get('/livres', LivresController::class);

Route::get('/livres/add', [LivresController::class, 'addForm'])->perm("add");
Route::post('/livres/add', [LivresController::class, 'add'])->perm("add");

Route::get('/livres/{id}', [LivresController::class, 'show']);

Route::get('/livres/{id}/update', [LivresController::class, 'updateForm'])->perm("edit");
Route::post('/livres/{id}/update', [LivresController::class, 'update'])->perm("edit");

Route::get('/livres/{id}/delete', [LivresController::class, 'deleteForm'])->perm("delete");
Route::post('/livres/{id}/delete', [LivresController::class, 'delete'])->perm("delete");


// ======
// Routes odeur
// ======
Route::get('/odeurs', OdeursController::class);

Route::get('/odeurs/add', [OdeursController::class, 'addForm'])->perm("add");
Route::post('/odeurs/add', [OdeursController::class, 'add'])->perm("add");

Route::get('/odeurs/{id}', [OdeursController::class, 'show']);

Route::get('/odeurs/{id}/update', [OdeursController::class, 'updateForm'])->perm("edit");
Route::post('/odeurs/{id}/update', [OdeursController::class, 'update'])->perm("edit");

Route::get('/odeurs/{id}/delete', [OdeursController::class, 'deleteForm'])->perm("delete");
Route::post('/odeurs/{id}/delete', [OdeursController::class, 'delete'])->perm("delete");


// ======
// Routes recette
// ======
Route::get('/recettes', RecettesController::class);

Route::get('/recettes/add', [RecettesController::class, 'addForm'])->perm("add");
Route::post('/recettes/add', [RecettesController::class, 'add'])->perm("add");

Route::get('/recettes/{id}', [RecettesController::class, 'show']);

Route::get('/recettes/{id}/update', [RecettesController::class, 'updateForm'])->perm("edit");
Route::post('/recettes/{id}/update', [RecettesController::class, 'update'])->perm("edit");

Route::get('/recettes/{id}/delete', [RecettesController::class, 'deleteForm'])->perm("delete");
Route::post('/recettes/{id}/delete', [RecettesController::class, 'delete'])->perm("delete");




// ======
// Routes admin
// ======
Route::get('/admin', AdminController::class)->perm("admin");

Route::get('/admin/{id}/update', [AdminController::class, 'updateForm'])->perm("admin");
Route::post('/admin/{id}/update', [AdminController::class, 'update'])->perm("admin");

Route::get('/admin/{id}/delete', [AdminController::class, 'deleteForm'])->perm("admin");
Route::post('/admin/{id}/delete', [AdminController::class, 'delete'])->perm("admin");
