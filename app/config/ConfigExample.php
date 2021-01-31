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
     * @return array Configuration utilisée par la classe Application
     */
    public static function loadConfig(): array
    {
        $config['db_driver'] = 'mysql';
        $config['db_host'] = '127.0.0.1';
        $config['db_port'] = '3306';
        $config['db_name'] = 'bougies';
        $config['db_user'] = 'root';
        $config['db_password'] = '';

        $config['template_key'] = 'layout';
        $config['debug'] = true;

        return $config;
    }
}
