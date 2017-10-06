<?php namespace App\Controllers;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class HomeController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        echo $this->template->render('error/notfound.twig');
    }
}
