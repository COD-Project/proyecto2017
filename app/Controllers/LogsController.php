<?php namespace App\Controllers;

use App\Storage\File;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class LogsController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
            'logged' => true
        ], [
            'log_index'
        ]);

        $file = new File('uploads/logs/firewall.logs');
        
        echo $file->content();
    }
}
