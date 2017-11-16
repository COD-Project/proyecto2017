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

        $this->app->get('/auth', function() {
            return new Api;
        });
        
        $this->app->run();
    }
}
