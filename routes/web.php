<?php

use app\controllers\IndexController;
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

Route::get('/users/{id}', function ($id) {
    echo "id : $id";
});

Route::get('/events/{id}', [IndexController::class, 'showEvent']);

Route::get('/events', [IndexController::class, 'events']);