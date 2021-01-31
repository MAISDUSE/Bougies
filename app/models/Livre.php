<?php

namespace app\models;

use core\Model;

/**
 * Class Livre
 * @package app\models
 */
class Livre extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'livre';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id_livre';

    /**
     * Relation livre *...1 auteur
     * @return Auteur Instance du Model Auteur
     */
    public function auteur(): Auteur
    {
        return $this->belongsTo(Auteur::class, $this->id_auteur);
    }

    /**
     * Relation livre 1...* bougies
     * @return array Tableau des bougies du livre
     */
    public function bougies(): array
    {
        return $this->hasMany(Bougie::class);
    }
}
