<?php namespace App;

/**
 * @author Ulises J. Cornejo Fandos
 */
class Config
{
    protected static $data;

    protected static function prepareDefault()
    {
        # Timezone DOC http://php.net/manual/es/timezones.php
        date_default_timezone_set('America/Argentina/Buenos_Aires');
    }

    protected static function prepareData()
    {
        $serverjson = json_decode(
          file_get_contents("config/server.json"),
          true
        );

        $configjson = json_decode(
          file_get_contents("uploads/settings.json"),
          true
        );

        $dbjson = json_decode(
          file_get_contents("config/db.json"),
          true
        );

        static::$data = array_merge($serverjson, $dbjson, $configjson);
    }

    protected static function defineDBConstants()
    {
        $db = static::$data['database'];

        /**
         * Settings for DB connection.
         * @param host 'Server for connection to the database -> local/remote hosting'
         * @param user 'Database user'
         * @param pass 'Password of the database user'
         * @param name 'Database name'
         * @param port 'Database port (not required on most engines)'
         * @param protocol 'Connection protocol (not required on most engines)'
         * @param driver 'Default connection engine'
         * MOTORS VALUES:
         *        mysql
         *        sqlite
         *        oracle
         *        postgresql
         *        cubrid
         *        firebird
         *        odbc
         */
        define('DATABASE_HOST', $db['host']);
        define('DATABASE_USER', $db['user']);
        define('DATABASE_PASSWORD', $db['pass']);
        define('DATABASE_NAME', $db['name']);
        define('DATABASE_PORT', $db['port']);
        define('DATABASE_PROTOCOL', $db['protocol']);
        define('DATABASE_DRIVER', $db['driver']);
        define('PHP_INT_MIN', -9223372036854775808);
    }


    protected static function defineAppConstants()
    {
        /**
         * Defines the directory in which the framework is installed
         * @example "/" If to access the framework we place http://url.com in the URL, or http://localhost
         * @example "/mbh-framework/" if to access the framework we place http://url.com/mbh-framework, or http://localhost/mbh-framework/
         */
        define('__ROOT__', static::$data['root']);
        define('URL', static::$data['url']);
        define('DEBUG', static::$data['debug']);
    }

    public static function defineSettingConstants($data = null)
    {
        if (!$data) {
            $data = static::$data;
        }

        define('APP_NAME', $data['name']);
        define('AMOUNT_PER_PAGE', $data['amount_per_page']);
        define('MAINTENANCE', $data['maintenance']);
        define('CONTACT', $data['contact']);
        define('DESCRIPTION', $data['description']);
    }

    protected static function defineConstants()
    {
        static::defineDBConstants();
        static::defineAppConstants();
    }

    public static function init()
    {
        static::prepareDefault();
        static::prepareData();
        static::defineConstants();
    }

    public static function controllers()
    {
        return json_encode(file_get_contents("config/controllers.json"), true);
    }
}
