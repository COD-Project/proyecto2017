<?php namespace App\Traits;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
trait Connection
{
    protected static $db;

    static function init($settings = [], $new_instance = true)
    {
        if (!static::$db instanceof Connection or $new_instance) {
            static::$db = new Connection();
        }

        return static::$db;
    }
}
