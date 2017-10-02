<?php namespace App;

use App\Connection\Connection;

/**
 * created by Ulises J. Cornejo Fandos
 */
class Model extends \Mbh\Model
{
    public static function init($settings = [])
    {
        static::$db = new Connection();
    }

    public function __construct($state = [])
    {
        $this->state = $state;
    }
}
