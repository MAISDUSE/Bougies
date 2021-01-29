<?php


namespace core;


class Session
{
    public static function setOld($array)
    {
        $_SESSION['old'] = $array;
    }
    public static function addError(string $title, string $text)
    {
        $_SESSION['flash'][$title] = "<script>toastr.error('$text', '$title', {progressBar: true, timeOut:5000, closeButton: true})</script>";
    }

    public static function addSuccess(string $title, string $text)
    {
        $_SESSION['flash'][$title] = "<script>toastr.success('$text', '$title', {progressBar: true, timeOut:5000, closeButton: true})</script>";
    }

    public static function addInfo(string $title, string $text)
    {
        $_SESSION['flash'][$title] = "<script>toastr.info('$text', '$title', {progressBar: true, timeOut:5000, closeButton: true})</script>";
    }
}