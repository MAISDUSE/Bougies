<?php

namespace core;

/**
 * Class Router
 * @package core
 */
class Router
{
    /**
     * @var array $routes Tableau contenant les routes
     */
    public array $routes;

    /**
     * @var Request $request Instance de la classe Request, récupère la méthode (get, post) et l'url
     */
    public Request $request;

    /**
     * constante associée à l'emplacement du dossier contenant les routes
     */
    public const ROUTES_PATH = "../routes";

    /**
     * @var array $args Tableau contenant les arguments passés à la route
     */
    public array $args = [];

    /**
     * Router constructor. Récupère les routes et crée une instance de request
     */
    public function __construct()
    {
        $this->routes = $this->getRoutes();

        $this->request = new Request();
    }

    /**
     * Récupère les routes contenues dans le dossier routes
     * @return array Tableau contenant les routes
     */
    public function getRoutes() : array
    {
        $routeFiles = glob(self::ROUTES_PATH.'/*.php');

        foreach ($routeFiles as $routeFile)
        {
            require_once "$routeFile";
        }

        return Route::$routes;
    }

    /**
     * récupère la méthode et l'url
     * si l'url est associée à une route, exécute l'action correspondante
     */
    public function resolveRoute()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->match($method, $path);

        if ($callback === false)
        {
            (new View())->show404();
        }

        try
        {
            call_user_func_array($callback, $this->args);
        }
        catch (\Exception $exception)
        {
            ExceptionHandler::raiseException($exception->getMessage(), $exception->getTrace());
        }

        restore_error_handler();
    }

    /**
     * Détermine si l'url est associé à une route
     * Retourne la fonction à executer sous forme de tableau ou de fonction, false si l'url n'est pas associée à une route
     * @param string $method Méthode (get, post)
     * @param string $path Url
     * @return array|false|mixed
     */
    public function match(string $method, string $path)
    {
        $callback = $this->routes[$method][$path] ?? false; //Si la route n'accepte pas de paramètres, alors elle peut être associée directement sinon le retour est a false
        $remainingRoutes = $this->routes[$method]; //Routes à traiter dans le cas ou la route n'est pas associée

        //si le retour ($callback) est à false et si il reste des routes à traiter
        while ($remainingRoutes != [] && $callback === false)
        {
            $route = array_key_first($remainingRoutes); //récupère la première clé du tableau des routes à traiter

            //Une route avec un paramètre contiendra '{'
            if (strpos($route, '{'))
            {
                $url = trim($path, '/'); //On retire le 1er / pour éviter un conflit avec les expressions régulières
                $routeRegex = preg_replace("#{(\w+)}#", '([^/]+)', $route); //transforme la route paramétrée en expression régulière
                $routeRegex = trim($routeRegex, '/'); //enlève le 1er /

                if (preg_match("#^$routeRegex$#", $url, $matches)) //teste si la route paramétrée transformée en expression régulière match l'url
                {
                    $callback = $this->routes[$method][$route]; //récupère l'action à effectuer en cas de match
                }

                //le 1er élément de $matches est l'expression testée, ses éléments suivants contiennent les expressions correspondant à l'expression régulière
                array_shift($matches);
                $this->args = $matches; //place les arguments de la route dans le tableau des arguments
            }

            array_shift($remainingRoutes); //élément traité, on le retire
        }

        //Si l'action à effectuer est un tableau, on instancie le 1er élément du tableau (Controller) et on le replace
        if (is_array($callback))
        {
            $callback[0] = new $callback[0]($this->request);
        }

        //Si l'action à effectuer est une chaine de caratère (nom du controller), on le transforme en tableau et on instancie le controller en 1ere position, puis la méthode par défaut dans le 2e
        if (is_string($callback))
        {
            $action = $callback;
            $callback = [];
            $callback[0] = new $action($this->request);
            $callback[1] = 'index';
        }

        //3 retours possibles pour $callback
        //1 -> une fonction -> Object(Closure)
        //2 -> un tableau -> [Controller, method]
        //3 -> false -> l'url ne correspond à aucune route
        return $callback;
    }
}
