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
    private array $param = [];

    /**
     * Constante du dossier ressources
     */
    private const VIEW_FOLDER = __DIR__ . "/../resources/views/";

    /**
     * Assigne un paramètre à une vue
     * @param string $varName Nom de la variable passée à la vue
     * @param mixed $value Valeur de la variable passsée à la vue
     */
    function assign(string $varName, $value)
    {
        $this->param[$varName] = $value;
    }

    /**
     * Charge la vue
     * @param string $filename Nom de la vue
     */
    function display(string $filename)
    {
        if (!preg_match('#\.php$#', $filename)) $filename .= ".php";

        $view = self::VIEW_FOLDER . $filename;

        foreach ($this->param as $key => $value)
        {
            $$key = $value;
        }

        if (!file_exists($view)) ExceptionHandler::raiseException("ViewNotFoundException", "The view $view does not exists.");

        $regex = "#" . Application::$app->config['template_key'] . ".php$#";

        if (preg_match($regex, $view))
        {
            $this->renderWithTemplate($filename);
        }
        else
        {
            include $view;
        }
    }

    /**
     * Assigne les paramètres et charge la vue
     * @param string $filename Nom de la vue
     * @param array $param Paramètres de la vue
     */
    public function render(string $filename, $param = array())
    {
        $param['csrf'] = $_SESSION['csrf'];
        foreach ($param as $key => $value)
        {
            $this->assign($key, $value);
        }

        $this->display($filename);
    }

    /**
     * Génère la vue après parsing des templates
     * @param string $view nom de la vue passée en paramètre
     */
    private function renderWithTemplate(string $view)
    {
        (new Builder($view))->make();
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
        $this->render("errors/$code", [
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
