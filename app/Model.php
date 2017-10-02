<?php namespace App;

use App\Connection\Connection;

/**
 * created by Ulises J. Cornejo Fandos
 */
class Model extends \Mbh\Model
{
    use \App\Traits\ConnectionInit;

    function __construct($state = [])
    {
        $this->state = $state;
    }
}
