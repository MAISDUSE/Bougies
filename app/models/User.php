<?php

namespace app\models;

use core\Model;

/**
 * Class User
 * @package app\models
 */
class User extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'user';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id';
}
