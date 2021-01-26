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

    protected static string $primaryKey;

    /**
     * Récupère tous les éléments d'une table
     * @return array
     */
    public static function all() : array
    {
        return Application::$app->db->selectAll(static::$table);
    }

    public static function find($elem)
    {
        return Application::$app->db->find(static::$table, static::$primaryKey, $elem);
    }

    public static function create($newElem)
    {
        return Application::$app->db->save(static::$table, static::$primaryKey, $newElem);
    }

    public static function update($elem, $update)
    {

    }

    public static function delete($elem)
    {
        return Application::$app->db->delete(static::$table, static::$primaryKey, $elem);
    }
}