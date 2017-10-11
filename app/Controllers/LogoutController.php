<?php namespace App\Controllers;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class LogoutController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->session->checkLife(true);

        $this->redirect();
    }
}