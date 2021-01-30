<?php

namespace app\models;

use core\Model;

class Livre extends Model
{
    protected string $table = 'livre';
    protected string $primaryKey = 'id_livre';

    public function auteur()
    {
        return $this->belongsTo(Auteur::class, $this->id_auteur);
    }
}
