<?php

use core\Route;

/* Définition des routes API
    Syntaxe : Route::[get|post](uri, callback);
    callback :
        Controller (méthode par défaut appelée [index])
        [Controller, method]
        fonction anonyme : function () {}
*/

Route::get('/api', function () {
    echo "api route";
});
