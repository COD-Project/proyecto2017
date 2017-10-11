<?php namespace App\Connection;

use Mbh\Connection\Engines\Mysql;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class Connection extends Mysql
{
    function __construct()
    {
        parent::__construct(array(
          'host' => DATABASE_HOST,
          'port' => DATABASE_PORT,
          'name' => DATABASE_NAME,
          'user' => DATABASE_USER,
          'pass' => DATABASE_PASSWORD
        ));
    }
}
