<?php namespace App\Controllers;

/**
 * @author Ulises J. Cornejo Fandos
 */
class TurnosController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);


        $this->app->get('/users', [ $this, 'render' ]);

        $this->app->run();
    }
}
