<?php

namespace app\models;

use core\Model;

/**
 * Class Recette
 * @package app\models
 */
class Recette extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'recette';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id_recette';

    /**
     * Relation recettes *...1 bougie
     * @return Bougie Instance du Model Bougie
     */
    public function bougie(): Bougie
    {
        return $this->belongsTo(Bougie::class, $this->id_bougie);
    }

    /**
     * Relation recettes *...1 odeur
     * @return Odeur Instance du Model Odeur
     */
    public function odeur(): Odeur
    {
        return $this->belongsTo(Odeur::class, $this->id_odeur);
    }
}
