<?php

namespace app\models;

use core\Model;

class Event extends Model
{
    protected string $table = 'event';
    protected string $primaryKey = 'id';

    public function bougies(): array
    {
        return $this->hasManyAssoc(Bougie::class, "events", "id_bougie", "id_event");
    }
}
