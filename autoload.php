<?php

//autoload
spl_autoload_register(function ($class)
{
    $file = str_replace('\\', '/', $class);
    require_once "$file.php";
});

set_error_handler(
    function ($severity, $message, $file, $line) {
        ob_clean();
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
);