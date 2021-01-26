<?php

namespace core;

use PDO;

/**
 * Class Database
 * @package core
 */
class Database
{
    public PDO $pdo;

    /**
     * Database constructor.
     * Initialise database connection from config
     * @param array $config retrieve database configuration
     */
    public function __construct(array $config)
    {
        /*foreach ($config as $key => $value)
        {
            if (strpos('db_', $key))
            {
                $$key = $value;
            }
        }*/

        $db_driver = $config['db_driver'];
        $db_host = $config['db_host'];
        $db_port = $config['db_port'];
        $db_name = $config['db_name'];
        $db_user = $config['db_user'];
        $db_password = $config['db_password'];

        $this->pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", "$db_user", "$db_password");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function selectAll(string $tableName): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM $tableName");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function find(string $tableName, string $primaryKey, $elem)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $tableName WHERE $primaryKey = '$elem'");

        $statement->execute();

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function save(string $tableName, string $primaryKey, $newElem)
    {
        $attrs = '';
        $values = '';

        foreach ($newElem as $attr => $value)
        {
            if (!empty($value))
            {
                $attrs .= "$attr, ";
                $values .= "'$value', ";
            }
        }

        $attrs = rtrim($attrs, ', ');
        $values = rtrim($values, ', ');

        $statement = $this->pdo->prepare("INSERT INTO $tableName ($attrs) VALUES ($values) ");

        $statement->execute();

        return $this->find($tableName, $primaryKey, $this->pdo->lastInsertId());
    }

    public function update(string $tableName, string $primaryKey, $elem, $newElem)
    {

    }

    public function delete(string $tableName, string $primaryKey, string $elem)
    {
        $backup = $this->find($tableName, $primaryKey, $elem);

        $this->pdo->prepare("DELETE FROM $tableName WHERE $primaryKey = '$elem'")->execute();

        return $backup;
    }
}