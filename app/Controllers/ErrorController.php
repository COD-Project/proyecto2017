<?php namespace App\Controllers;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class ErrorController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        require "web/public/error/404.phtml";
    }
}
