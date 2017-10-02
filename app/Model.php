<?php namespace App;

use App\Connection\Connection;

/**
 * created by Ulises J. Cornejo Fandos
 */
class Model extends \Mbh\Model
{
  public static function init($settings = [], $new_instance = true)
  {
        if (!static::$db instanceof Connection or $new_instance) {
            static::$db = new Connection();
        }

        return static::$db;
  }

    public function __construct($state = [])
    {
        $this->state = $state;
    }
}
