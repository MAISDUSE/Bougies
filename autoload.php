<?php

//autoload
spl_autoload_register(function ($class)
{
    $file = str_replace('\\', '/', $class);
    require_once "$file.php";
});