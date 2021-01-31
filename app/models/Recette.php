<?php

namespace app\models;

use core\Model;

class Recette extends Model
{
    protected string $table = 'recette';
    protected string $primaryKey = 'id_recette';

    /*public function odeur()
    {
        return $this->has(Odeur::class, $this->id_odeur);
    }*/

    public function bougie()
    {
        return $this->belongsTo(Bougie::class, $this->id_bougie);
    }
    public function odeur()
    {
        return $this->belongsTo(Odeur::class, $this->id_odeur);
    }
}
