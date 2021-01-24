<?php

namespace core;

abstract class Model
{
    public static function all()
    {
        return self::class . "test";
    }
}