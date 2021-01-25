<?php

namespace core;

/**
 * Class Model
 * @package core
 */
abstract class Model
{
    /**
     * Récupère tous les éléments d'une table
     * @return array
     */
    public static function all() : array
    {
        return [self::class . "test"];
    }
}