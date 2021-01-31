<?php

namespace app\models;

use core\Model;

/**
 * Class Bougie
 * @package app\models
 */
class Bougie extends Model
{
    /**
     * @var string $table Nom de la table
     */
    protected string $table = 'bougie';

    /**
     * @var string $primaryKey Nom de la clé primaire
     */
    protected string $primaryKey = 'id_bougie';

    /**
     * Relation bougie *...1 collection
     * @return Collection Instance du Model Collection
     */
    public function collection(): Collection
    {
        return $this->belongsTo(Collection::class, $this->id_collection);
    }

    /**
     * Relation bougie *...1 livre
     * @return Livre Instance du Model Livre
     */
    public function livre(): Livre
    {
        return $this->belongsTo(Livre::class, $this->id_livre);
    }

    /**
     * Relation auteur 1...* recettes
     * @return array Tableau des recettes de la bougie
     */
    public function recettes(): array
    {
        return $this->hasMany(Recette::class);
    }

    /**
     * Relation event *...* bougie
     * @return array Tableau de Model Event via la table association "events"
     */
    public function events(): array
    {
        return $this->hasManyAssoc(Event::class, "events", "id_event");
    }
}