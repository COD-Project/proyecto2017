<?php namespace App\Controllers;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class DebugController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
            'logged' => true
        ], [
            'debug_index'
        ]);

        $this->app->debug();
    }
}
