<?php

use app\controllers\IndexController;
use core\Route;

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