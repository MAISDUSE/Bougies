<?php

use app\controllers\BougiesController;
use app\controllers\IndexController;
use app\controllers\UsersController;
use app\controllers\AuteursController;
use app\controllers\CollectionsController;
use app\controllers\EventsController;
use app\controllers\LivresController;
use app\controllers\OdeursController;
use app\controllers\RecettesController;

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
   \core\Application::$app->response->redirect('/login');
});


Route::get('/events/{id}', [IndexController::class, 'showEvent']);

Route::get('/events', [IndexController::class, 'events']);

Route::get('/bougies', [IndexController::class, 'bougies']);
Route::get('/bougies/{id}', [IndexController::class, 'getBougie']);
Route::get('/bougies/{id}/delete', [BougiesController::class, 'delete']);
Route::get('/bougies/{id}/update', [BougiesController::class, 'update']);


Route::get('/bougies/testInsert', [BougiesController::class, 'testInsert']);


//AuteursController
Route::get('/auteurs', AuteursController::class);


Route::get('/auteurs/add', [AuteursController::class, 'addForm']);
Route::post('/auteurs/add', [AuteursController::class, 'add']);

Route::get('/auteurs/{id}/update', [AuteursController::class, 'updateForm']);
Route::post('/auteurs/{id}/update', [AuteursController::class, 'update']);

Route::get('/auteurs/{id}/delete', [AuteursController::class, 'deleteForm']);
Route::post('/auteurs/{id}/delete', [AuteursController::class, 'delete']);

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

//LivresController
Route::get('/livres', LivresController::class);

//OdeursController
Route::get('/odeurs', OdeursController::class);

//RecettesController
Route::get('/recettes', RecettesController::class);
