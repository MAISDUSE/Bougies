<?php


namespace core;


class Validation
{
    public static array $rules = [
        'required',
        'unique',
        'email',
        'num'
    ];

    public function validate() : bool
    {
        return true;
    }
}