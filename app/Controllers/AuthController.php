<?php namespace App\Controllers;

use App\Auth;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class AuthController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app);

        new Api;
    }
}
