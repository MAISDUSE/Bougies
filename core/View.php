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
    public string $template_key;

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

        if (!preg_match('#\.php$#', $filename))
        {
            $filename .= ".$this->template_key.php";
            $isTemplate = true;
        }

        $view = self::VIEW_FOLDER . $filename;

        if (!is_file($view)) ExceptionHandler::raiseException("ViewNotFoundException", "The view $view does not exists.");

        foreach ($this->param as $key => $value)
        {
            $$key = $value;
        }

        ob_start();

        include $view;

        if ($isTemplate)
        {
            $view = ob_get_contents();
            ob_clean();

            // ======== CSRF TOKENS ==========
            $token = $_SESSION['csrf'];
            $view = str_replace("@csrf", "<input type=\"hidden\" value=\"$token\" name=\"csrf\">", $view);


            // ======== VIEW EXTENSION ==========
            if (preg_match("#^@extends\('([^']+)'\)#", $view, $matches))
            {
                $extendedView = self::VIEW_FOLDER . $matches[1]  . ".$this->template_key.php";

                if (!is_file($extendedView))
                {
                    ob_end_clean();
                    ExceptionHandler::raiseException("ViewNotFoundException", "The view $extendedView does not exists.");
                }

                $view = str_replace("$matches[0]", '', $view);

                include $extendedView;

                $extendedView = ob_get_contents();
                ob_clean();

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

                echo $extendedView;
            }
            else
            {
                echo $view;
            }
        }

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

        $this->render("errors/$code.php", [
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
        $this->showError(404, "Page non trouvée", "La page que vous cherchez n'existe pas <a href='/'>Retour à l'accueil</a>");
    }
}
