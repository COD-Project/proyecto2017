<?php namespace App\Controllers;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class UsersController extends \App\Controller
{
    function __construct($app, $method = null, $data = null)
    {
        parent::__construct($app);

        echo 'Users Controller';
    }
}
