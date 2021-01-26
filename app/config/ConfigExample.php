<?php

namespace app\config;

/**
 * Class ConfigExample -> exemple de configuration
 * Pour garder la confidentialité le fichier de configuration ne sera pas git
 * Pour configuer, renommer la classe et le fichier en Config.
 * Ensuite editer la configuration dans la méthode loadConfig
 * @package app\config
 */
class ConfigExample
{
    /**
     * Retourne la configuration
     * @return array $config Configuration utilisé par la classe Application
     */
    public static function loadConfig() : array
    {
        $config['db_host'] = 'localhost';
        $config['db_port'] = '3306';
        $config['db_name'] = 'table';
        $config['db_user'] = 'user';
        $config['db_password'] = 'password';

        return $config;
    }
}