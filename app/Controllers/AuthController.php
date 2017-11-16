<?php namespace App\Controllers;

use App\Api;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class AuthController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        new Api;
    }
}
