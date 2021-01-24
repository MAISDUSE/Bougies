<?php

namespace core;

/**
 * @author Hugo
 * Class Route, used to create uro associations
 */
class Route
{
    public static function get($uri, $callback)
    {
        echo "$uri : $callback<br>";
    }
}