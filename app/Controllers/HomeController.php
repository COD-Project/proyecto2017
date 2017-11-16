<?php namespace App\Controllers;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class HomeController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app);

        if (MAINTENANCE) {
            header('location:' . URL . 'error/500');
        }

        echo $this->template->render('home/home.twig');
    }
}
