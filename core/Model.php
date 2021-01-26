<?php

namespace core;

/**
 * Class Model
 * @package core
 */
abstract class Model
{
    /**
     * Nom de la table associée au model dans la bdd
     * @var string $table
     */
    protected static string $table;

    /**
     * Clé primaire de la table associée au Model
     * @var string $primaryKey
     */
    protected static string $primaryKey;

    /**
     * Récupère tous les éléments d'une table
     * @return array
     */
    public static function all() : array
    {
        return Application::$app->db->selectAll(static::$table);
    }

    /**
     * Recherche un élément dans la BDD
     * @param mixed $elem identifiant de l'élément à rechercher, le type dépend de la table
     * @return false|mixed retourne l'élément trouvé si il existe
     */
    public static function find($elem)
    {
        $found = Application::$app->db->find(static::$table, static::$primaryKey, $elem);

        if ($found === false)
        {
            (new View)->show404();
        }
        return $found;
    }

    /**
     * Crée un nouvel élément en BDD
     * Retourne l'élément créé
     * @param array $newElem Tableau associatif représentant le nouvel élément à créer
     * @return mixed Retourne l'élément créé
     */
    public static function create(array $newElem)
    {
        return Application::$app->db->save(static::$table, static::$primaryKey, $newElem);
    }

    public static function update($elem, $updatedElem)
    {
        return Application::$app->db->update(static::$table, static::$primaryKey, $elem, $updatedElem);
    }

    /**
     * Supprime l'élément de la BDD
     * Retourne l'élément supprimé
     * @param mixed $elem identifiant de l'élément à rechercher, le type dépend de la table
     * @return mixed Retourne l'élément supprimé
     */
    public static function delete($elem)
    {
        return Application::$app->db->delete(static::$table, static::$primaryKey, $elem);
    }
}