<?php

namespace app\models;

use core\Model;

/**
 * Class Event
 * @package app\models
 */
class Event extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'event';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id';

    /**
     * Relation event *...* bougie
     * @return array Tableau de Model Bougie via la table association "events"
     */
    public function bougies(): array
    {
        return $this->hasManyAssoc(Bougie::class, "events", "id_bougie", "id_event");
    }
}
