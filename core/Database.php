<?php

namespace core;

use PDO;

/**
 * Class Database
 * @package core
 */
class Database
{
    /**
     * @var PDO $pdo Instance de PDO
     */
    public PDO $pdo;

    /**
     * Database constructor.
     * Initialise la connexion à la BDD à partir de la config
     * @param array $config tableau de configuration
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

        try
        {
            $this->pdo = new PDO("$db_driver:host=$db_host;port=$db_port;dbname=$db_name", "$db_user", "$db_password");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $exception)
        {
            ExceptionHandler::raiseException($exception->getMessage(), $exception->getTrace());
        }
    }

    /**
     * Récupère toutes les entrées d'une table
     * @param string $tableName Nom de la table
     * @param string $model nom du Model pour le tableau de retour
     * @return array Tableau d'objets correspondants à la requete
     */
    public function selectAll(string $tableName, string $model): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM $tableName");

        $statement->setFetchMode(PDO::FETCH_CLASS, $model);

        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Récupère toutes les entrées d'une table selon la (les) colonne
     * @param string $column Nom de la ou des colonnes
     * @param string $tableName Nom de la table
     * @param string $model Nom du Model pour le tableau de retour
     * @return array Tableau de Model
     */
    public function select(string $column, string $tableName, string $model): array
    {
        $statement = $this->pdo->prepare("SELECT $column FROM $tableName");

        $statement->setFetchMode(PDO::FETCH_CLASS, $model);

        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Récupère toutes les entrées correspondantes à la condition col = elemId
     * @param string $tableName Nom de la table
     * @param string $colName Nom de la colone sur laquelle le where est appliqué
     * @param mixed $elem Identifiant de l'élément à rechercher
     * @param mixed $model Nom du modèle pour le tableau de retour
     * @return array Tableau de Model
     */
    public function where(string $tableName, string $colName, $elem, $model = false): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM $tableName WHERE $colName = :elem");

        $this->bindValues($statement, ['elem' => $elem]);

        if ($model === false)
        {
            $statement->setFetchMode(PDO::FETCH_ASSOC);
        }
        else
        {
            $statement->setFetchMode(PDO::FETCH_CLASS, $model);
        }

        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Compte toutes les entrées d'une table
     * @param string $tableName Nom de la table
     * @return integer Nombre d'éléments dans la table
     */
    public function countAll(string $tableName): int
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) AS number FROM $tableName");

        $statement->execute();

        return intval($statement->fetch(PDO::FETCH_OBJ)->number);
    }

    /**
     * Trouve un élément dans une table à partir de sa colonne de référence
     * @param string $tableName Nom de la table
     * @param string $columnName Nom de la colonne de la table
     * @param mixed $elem identifiant de l'élément
     * @param Model $model
     * @return mixed retourne une instance du model false sinon
     */
    public function find(string $tableName, string $columnName, $elem, Model $model)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $tableName WHERE $columnName = :elem");

        $this->bindValues($statement, ['elem' => $elem]);

        $statement->setFetchMode(PDO::FETCH_INTO, $model);

        $statement->execute();

        return $statement->fetch();
    }

    /**
     * Crée un élément en base de donnée et retourne l'id de l'élément créé
     * @param string $tableName Nom de la table
     * @param array $newElem Tableau associatif représentant le nouvel élément
     * @return mixed retourne une instance de l'élément créé
     */
    public function save(string $tableName, array $newElem): int
    {
        $attrs = '';
        $values = '';

        foreach ($newElem as $attr => $value)
        {
            $attrs .= "$attr, ";
            $values .= ":$attr, ";
        }
        //cas de l'attribut quantité en bdd
        $attrs = rtrim(str_replace("quantite", "quantité",$attrs), ', ');
        $values = rtrim($values, ', ');

        $statement = $this->pdo->prepare("INSERT INTO $tableName ($attrs) VALUES ($values)");

        $this->bindValues($statement, $newElem);

        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    /**
     * Modifie un élément de la BDD
     * @param string $tableName Nom de la table
     * @param string $primaryKey Clé primaire
     * @param mixed $elem identifiant de l'élément à modifier
     * @param array $updatedElem Tableau associatif des attributs à modifier
     */
    public function update(string $tableName, string $primaryKey, $elem, array $updatedElem)
    {
        $params = '';

        foreach ($updatedElem as $attr => $value)
        {
            //cas de l'attribut quantité en bdd
            $attr1 = str_replace("quantite","quantité",$attr);

            $params .= "$attr1 = :$attr, ";
        }

        $params = rtrim($params, ', ');

        $statement = $this->pdo->prepare("UPDATE $tableName SET $params WHERE $primaryKey = :elem");
        var_dump($statement);
        $this->bindValues($statement, $updatedElem);
        $this->bindValues($statement, ['elem' => $elem]);

        $statement->execute();
    }

    /**
     * Supprime une entrée d'une table passée en paramètre, retourne une instance de l'élément supprimé
     * @param string $tableName Nom de la table
     * @param string $primaryKey Clé primaire
     * @param string $elem identifiant de l'élément à supprimer
     */
    public function delete(string $tableName, string $primaryKey, string $elem)
    {
        $statement = $this->pdo->prepare("DELETE FROM $tableName WHERE $primaryKey = :elem");

        $this->bindValues($statement, ['elem' => $elem]);

        $statement->execute();
    }

    /**
     * Supprime une entrée d'une table passée en paramètre, retourne une instance de l'élément supprimé
     * @param string $tableName Nom de la table
     * @param string $where Condition de suppression
     */
    public function deleteWhere(string $tableName, string $where)
    {
        $statement = $this->pdo->prepare("DELETE FROM $tableName WHERE $where");

        $statement->execute();
    }

    /**
     * Associe les valeurs dans la requete préparée
     * @param object $statement Object PDO avec la requete
     * @param array $element Tableau associatif de l'élément à créer ou modifier
     */
    private function bindValues(object &$statement, array $element)
    {
        foreach ($element as $attr => $value)
        {
            $param = null;
            switch (gettype($value))
            {
                case "integer":
                    $param = PDO::PARAM_INT;
                    break;
                case "string":
                    $param = PDO::PARAM_STR;
                    break;
                default:
                    $param = PDO::PARAM_NULL;
                    break;
            }

            $statement->bindValue(":$attr", $value, $param);
        }
    }

    /**
     * Execute la requete brute passée en paramètre
     * @param string $request Requete
     * @return array réponse
     */
    public function raw(string $request): array
    {
        $statement = $this->pdo->prepare($request);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
