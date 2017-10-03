<?php namespace App\Controllers;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class HomeController extends \App\Controller
{
    function __construct($app, $method = null, $data = null)
    {
        parent::__construct($app, $method, $data);

        echo $this->template->render('patient/patient.twig');
    }
}
