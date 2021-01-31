<?php

namespace app\controllers;

use app\models\Auteur;
use app\models\Bougie;
use app\models\Event;
use app\models\Livre;
use \core\Controller;

/**
 * Class IndexController
 * @package app\controllers
 */
class IndexController extends Controller
{
    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        $rows = Bougie::raw('SELECT `statut_bougie`, COUNT(`statut_bougie`) AS nombre FROM bougie GROUP BY `statut_bougie`');

        $taux = ["validée" => 0, "neutre" => 0, "rejetée" => 0];
        foreach ($rows as $row)
        {
            $taux[$row["statut_bougie"]] = $row["nombre"];
        }

        $this->view->render("index", [
            "nbBougies" => Bougie::count(),
            "nbLivres" => Livre::count(),
            "nbAuteurs" => Auteur::count(),
            "nbEvents" => Event::count(),
            'taux' => $taux
        ]);
    }
}
