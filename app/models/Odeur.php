<?php

namespace app\models;

use core\Model;

/**
 * Class Odeur
 * @package app\models
 */
class Odeur extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'odeur';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id_odeur';

    /**
     * Relation odeur 1...* recettes
     * @return array Tableau des recettes de odeur
     */
    public function recettes(): array
    {
        return $this->hasMany(Recette::class);
    }
}
