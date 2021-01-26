<?php

namespace app\models;

use core\Model;

class User extends Model
{
    protected static string $table = 'user';

    protected static string $primaryKey = 'id';
}
