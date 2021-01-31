<?php

namespace app\models;

use core\Model;

/**
 * Class Auteur
 * @package app\models
 */
class Auteur extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'auteur';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id_auteur';

    /**
     * Relation auteur 1...* livres
     * @return array Tableau des livres de l'auteur
     */
    public function livres(): array
    {
        return $this->hasMany(Livre::class);
    }
}
