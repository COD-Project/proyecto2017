<?php namespace App;

use Mbh\Collection;

/**
 * created by Ulises J. Cornejo Fandos
 */
class Router extends \Mbh\Router
{
    function get()
    {
        return new Collection($_GET);
    }

    function post()
    {
        return new Collection($_POST);
    }
}
