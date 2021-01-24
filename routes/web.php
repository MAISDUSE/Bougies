<?php

use app\controllers\IndexController;
use core\Route;

Route::get('/', IndexController::class);

Route::get('/test', function () {
    echo "Test function !<br>";
});


Route::get('/contact', [IndexController::class, 'contact']);
Route::post('/contact', [IndexController::class, 'sendMail']);


    Route::get('/users/{id}', [IndexController::class, 'showUser']);