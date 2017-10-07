<?php namespace App;

/**
 * created by Ulises J. Cornejo Fandos
 */
class Router extends \Mbh\Router
{
    function get()
    {
        return new \Mbh\Collection($_GET);
    }

    function post()
    {
        return new \Mbh\Collection($_POST);
    }
}
