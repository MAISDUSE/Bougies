<?php

namespace app\models;

use core\Model;

class Odeur extends Model
{
    protected string $table = 'odeur';
    protected string $primaryKey = 'id_odeur';

    public function recettes()
    {
        return $this->hasMany(Recette::class);
    }
}
