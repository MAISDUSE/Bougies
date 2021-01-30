<?php

namespace app\models;

use core\Model;

class Bougie extends Model
{
    protected string $table = 'bougie';
    protected string $primaryKey = 'id_bougie';

    public function collection()
    {
        return $this->belongsTo(Collection::class, $this->id_collection);
    }

    public function livre()
    {
        return $this->belongsTo(Livre::class, $this->id_livre);
    }

    public function recettes()
    {
        return $this->hasMany(Recette::class);
    }

    public function events(): array
    {
        return $this->hasManyAssoc(Event::class, "events", "id_event");
    }
}