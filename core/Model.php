<?php

namespace core;

/**
 * Class Model
 * @package core
 */
abstract class Model
{
    /**
     * @var string $table Nom de la table en BDD
     */
    protected string $table;

    /**
     * @var string $primaryKey Nom de la clé primaire de la table
     */
    protected string $primaryKey;

    /**
     * Sélectionne toutes les entrées de la table
     * @return array Tableau de Model
     */
    public static function all(): array
    {
        return Application::$app->db->selectAll((new static)->table, static::class);
    }

    /**
     * Selectionne selon la (les) colonne
     * @param string $selection Nom de la colonne passée en paramètre
     * @return array Tableau de model
     */
    public static function select(string $selection)
    {
        return Application::$app->db->select($selection, (new static)->table, static::class);
    }

    /**
     * Compte le nombre d'entrées dans la base
     * @return int Nombre d'entrées
     */
    public static function count(): int
    {
        return Application::$app->db->countAll((new static)->table);
    }

    /**
     * Cherche un élément dans la base selon sa clé primaire
     * @param mixed $elemId identifiant de l'élément
     * @return mixed Instance du model représenté par l'élément ou false si pas trouvé
     */
    public static function find($elemId)
    {
        $model = new static;
        $model = Application::$app->db->find($model->table, $model->primaryKey, $elemId, $model);
        return $model;
    }

    /**
     * Récupère toutes les entrées correspondantes à la condition col = elemId
     * @param string $columnName Nom de la colone sur laquelle le where est appliqué
     * @param mixed $elemId Identifiant de l'élément à rechercher
     * @return array Tableau de Model
     */
    public static function where(string $columnName, $elemId): array
    {
        return Application::$app->db->where((new static)->table, $columnName, $elemId, static::class);
    }

    /**
     * Execute la fonction find, si l'élément cherché n'existe pas, affiche une erreur
     * @param mixed $elemId Identifiant de l'élément recherché
     * @return mixed Retourne une instance du Model
     */
    public static function findOrFail($elemId)
    {
        $elem = static::find($elemId);

        if ($elem === false) (new View())->show404();

        return $elem;
    }

    /**
     * Détermine l'unicité d'un élément
     * @param mixed $elemId Identifiant de l'élément à prouver
     * @param mixed $colName Nom de la colonne sur laquelle chercher
     * @return bool Vrai si l'élément recherché n'existe pas en BDD
     */
    public static function unique($elemId, $colName = null): bool
    {
        $colName ?? (new static)->primaryKey;

        $elt = static::where($colName, $elemId);

        return count($elt) === 0;
    }

    /**
     * Crée un élément en BDD et retourne une instance de Model de l'élément créé
     * @param array $newElem Tableau associatif représentant le nouvel élément
     * @return mixed instance de model de l'élément créé
     */
    public static function create(array $newElem)
    {
        $lastId = Application::$app->db->save((new static)->table, $newElem);

        return static::find($lastId);
    }

    /**
     * Modifie un élément en BDD et retourne une instance de Model de l'élément modifié
     * @param mixed $elemId Identifiant de l'élément à modifier
     * @param array $newElem Tableau associatif des attributs à modifier
     * @return mixed Instance de Model de l'élément modifié
     */
    public static function update($elemId, array $newElem)
    {
        $model = new static;

        Application::$app->db->update($model->table, $model->primaryKey, $elemId, $newElem);

        $model = static::find($elemId);

        return $model;
    }

    /**
     * Supprime un élément en BDD et retourne une instance de model de l'élément supprimé
     * @param mixed $elemId Identifiant de l'élément à supprimer
     * @return mixed Instance de Model de l'élément supprimé
     */
    public static function delete($elemId)
    {
        $model = static::findOrFail($elemId);

        Application::$app->db->delete($model->table, $model->primaryKey, $elemId);

        return $model;
    }

    /**
     * Défini une relation d'appartenance à un autre Model
     * @param string $model Model auquel l'instance du Model courant appartient
     * @param mixed $foreignKeyValue Valeur de la colonne de la clé étrangère
     * @return mixed Instance du Model auquel le Model courant appartient
     */
    public function belongsTo(string $model, $foreignKeyValue)
    {
        return $model::find($foreignKeyValue);
    }

    /**
     * Défini une relation de possession d'un autre Model
     * @param string $model Model que l'instance du model courant possède
     * @return mixed instance du Model que le Model courant possède
     */
    public function has(string $model)
    {
        return $this->hasMany($model)[0];
    }

    /**
     * Défini une relation de possession de plusieurs autres Model
     * @param string $model Models que l'instance du model courant possède
     * @return mixed Tableau des instances des Model que le Model courant possède
     */
    public function hasMany(string $model)
    {
        $pk = $this->primaryKey;
        return $model::where($this->primaryKey, $this->$pk);
    }
}
