<?php

namespace core;

//CLasse minimaliste pour normaliser l'usage d'une vue.
//Cette classe est inspiré du moteur et compilateur de template Smarty

class View
{
    //Paramètres de la vue, dans un tableau associatif
    private array $param;
    private const VIEW_FOLDER = __DIR__ . "/../resources/views/";


    //constructeur d'une vue
    function __construct()
    {
        //initialise un tableau vide de Paramètres
        $this->param = array();
    }

    // Ajoute une variable à la vue
    function assign(string $varName, $value)
    {
        $this->param[$varName] = $value;
    }

    // Affiche la vue
    function display(string $filename)
    {
        // Ajoute le chemin relatif vers le fichier de la vue
        $p = self::VIEW_FOLDER . $filename . ".php";

        // Tous les attributs de l'objet sont dupliqués en des variables
        // locales à la fonction display. Cela simplifie l'expression des
        // valeurs de la vue. Il faut simplement utiliser <?= $variable

        // Parcourt toutes les variables de la vue
        foreach ($this->param as $key => $value)
        {
            // La notation $$ dédigne une variable dont le nom est dans une autre variable
            $$key = $value;
            // Création d'autant de variables locales qu'il y a d'atributs publics dans $this
        }

        // Inclusion de la vue
        // Comme cette inclusion est dans la portée de la méthode show alors
        // seules les variables locales à show sont visibles.
        return include($p); // A l'intérieur donc local a la methode show()
    }

    // Affiche toutes les valeurs des paramètres de la vue
    function dump()
    {
        foreach ($this->param as $key => $value)
        {
            print("<br/><b>$key: </b>\n");
            var_dump($value);
        }
    }

    //Fonction qui fait tout en un : assigne un tableau de paramètres et ensuite display la vue.
    function render(string $filename, $param = array())
    {
        foreach ($param as $key => $value)
        {
            $this->assign($key, $value);
        }

        return $this->display($filename);
    }

    function show404()
    {
        Application::$app->response->setStatusCode(404);
        $this->render("errors/404.php");
    }
}
