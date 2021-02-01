<?php

namespace core;

/**
 * Class View
 * @package core
 */
class View
{
    /**
     * @var array $param Paramètres de la vue
     */
    public array $param = [];

    /**
     * Constante du dossier ressources
     */
    public const VIEW_FOLDER = __DIR__ . "/../resources/views/";

    /**
     * @var string|mixed $template_key nom du mot clé identifiant une vue utilisant le "générateur de template"
     */
    public string $template_key;

    /**
     * View constructor.
     * Récupère la config
     */
    public function __construct()
    {
        $this->template_key = Application::$app->config['template_key'];
    }

    /**
     * Charge la vue
     * @param string $filename Nom de la vue
     */
    function display(string $filename)
    {
        $isTemplate = false;

        //Si pas d'extension -> vue template
        if (!preg_match('#\.php$#', $filename))
        {
            $filename .= ".$this->template_key.php";
            $isTemplate = true;
        }

        //Chemin de la vue
        $view = self::VIEW_FOLDER . $filename;

        //Si la vue n'existe pas
        if (!is_file($view)) ExceptionHandler::raiseException("ViewNotFoundException - The view $view does not exists.", debug_backtrace());

        //Flashdata -> old (Voir Session::class)
        if (isset($_SESSION['old']))
        {
            foreach ($_SESSION['old'] as $key => $value)
            {
                $$key = $value;
            }

            unset($_SESSION['old']);
        }

        //Paramètres de la vue
        foreach ($this->param as $key => $value)
        {
            $$key = $value;
        }

        //temporisation de la sortie
        ob_start();

        //récupération de la vue
        include $view;

        if ($isTemplate) //Si la vue utilise template
        {
            //Stockage de la vue pour traitement
            $view = ob_get_contents();
            ob_clean(); //Vidage du buffer

            // ======== CSRF TOKENS ==========
            $token = $_SESSION['csrf'];
            //Remplace l'instruction @csrf par sa valeur
            $view = str_replace("@csrf", "<input type=\"hidden\" value=\"$token\" name=\"csrf\">", $view);


            // ======== VIEW EXTENSION ========== -> si la vue hérite d'une vue parent
            if (preg_match("#^@extends\('([^']+)'\)#", $view, $matches))
            {
                //chemin vers la vue parent
                $extendedView = self::VIEW_FOLDER . $matches[1]  . ".$this->template_key.php";

                //Si la vue parent n'existe pas
                if (!is_file($extendedView))
                {
                    ob_end_clean();
                    ExceptionHandler::raiseException("ViewNotFoundException - The view $extendedView does not exists.", debug_backtrace());
                }

                //récupère la vue parent
                include $extendedView;

                //Stockage pour traitement
                $extendedView = ob_get_contents();
                ob_clean(); //Vidage du buffer

                //Définition des flashdata (Messages de Session::class)
                $flashdata = "";

                if (isset($_SESSION['flash']))
                {
                    foreach ($_SESSION['flash'] as $flash)
                    {
                        $flashdata .= $flash;
                    }

                    unset($_SESSION['flash']);
                }

                //Remplace l'instruction @flashdata
                $extendedView = str_replace("@flashdata", $flashdata, $extendedView);

                //Remplace les instructions de sections dans la vue parent par leur contenu de la vue parent
                if (preg_match_all("#@yield\('([^']+)'\)#", $extendedView, $yields))
                {
                    foreach ($yields[1] as $sectionName)
                    {
                        if (preg_match("#@section\('$sectionName'\)(.+?)@endsection#s", $view, $section))
                        {
                            $extendedView = str_replace("@yield('$sectionName')", $section[1], $extendedView);
                        }
                        else
                        {
                            $extendedView = str_replace("@yield('$sectionName')", '', $extendedView);
                        }
                    }
                }

                echo $extendedView; // envoie la vue au buffer
            }
            else
            {
                echo $view; // envoie la vue au buffer
            }
        }

        //Envoyer le buffeer et le vider
        ob_end_flush();
    }

    /**
     * Assigne les paramètres et charge la vue
     * @param string $filename Nom de la vue
     * @param array $param Paramètres de la vue
     */
    public function render(string $filename, $param = [])
    {
        $param['csrf'] = $_SESSION['csrf'];

        foreach ($param as $key => $value)
        {
            $this->param[$key] = $value;
        }

        $this->display($filename);
    }

    /**
     * Affiche une erreur
     * @param int $code Code erreur
     * @param string $title Nom de l'erreur
     * @param string|null $text Texte de l'erreur
     */
    public function showError(int $code, string $title, string $text = null)
    {
        Application::$app->response->setStatusCode($code);

        $this->render("errors/error", [
            'code' => $code,
            'title' => $title,
            'text' => $text
        ]);

        exit;
    }

    /**
     * Affiche une erreur 404
     */
    public function show404()
    {
        $this->showError(404, "Page non trouvée", "La page que vous recherchez n'existe pas.");
    }
}
