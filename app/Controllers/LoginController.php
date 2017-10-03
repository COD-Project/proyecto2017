<?php namespace App\Controllers;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class LoginController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        $session = new \App\Storage\Session();
        $session->generateSession(2);
    }
}
