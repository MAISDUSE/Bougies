<?php

//Chargement de l'autoloader
require_once "../autoload.php";

use core\Application;

//Initialisation du traitement
$app = new Application();

//Démarrage du traitement
$app->run();