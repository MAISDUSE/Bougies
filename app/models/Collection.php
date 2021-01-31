<?php

namespace app\models;

use core\Model;

/**
 * Class Collection
 * @package app\models
 */
class Collection extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'collection';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id_collection';

    /**
     * Relation Collection 1...* bougies
     * @return array Tableau des bougies de la collection
     */
    public function bougies(): array
    {
        return $this->hasMany(Bougie::class);
    }
}
