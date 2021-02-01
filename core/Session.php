<?php


namespace core;

/**
 * Class Session
 * @package core
 */
class Session
{
    /**
     * Flashdata -> défini une vielle valeur
     * Utilisée dans le cas de l'echec de remplissage d'un formulaire
     * @param array $array Talbleu à insérer dans la flash data
     */
    public static function setOld(array $array)
    {
        $_SESSION['old'] = $array;
    }

    /**
     * Message d'erreur destiné au client
     * @param string $title Titre de l'erreur
     * @param string $text Description de l'erreur
     */
    public static function addError(string $title, string $text)
    {
        $_SESSION['flash'][$title] = "<script>toastr.error('$text', '$title', {progressBar: true, timeOut:5000, closeButton: true})</script>";
    }

    /**
     * Message de succes destiné au client
     * @param string $title Titre de l'erreur
     * @param string $text Description de l'erreur
     */
    public static function addSuccess(string $title, string $text)
    {
        $_SESSION['flash'][$title] = "<script>toastr.success('$text', '$title', {progressBar: true, timeOut:5000, closeButton: true})</script>";
    }
}