<?php

namespace app\models;

use core\Model;

class Auteur extends Model
{
    protected string $table = 'auteur';
    protected string $primaryKey = 'id_auteur';

    public function livres()
    {
        return $this->hasMany(Livre::class);
    }
}
