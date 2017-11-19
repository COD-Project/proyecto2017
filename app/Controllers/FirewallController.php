<?php namespace App\Controllers;

use App\Storage\File;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class FirewallController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
            'logged' => true
        ], [
            'log_index'
        ]);

        $this->app->get('/firewall/show/logs', function () {
            try {
                $file = new File('uploads/logs/firewall.logs');

                $output = str_replace(PHP_EOL, '<br>', $file->content());
                return 'Firewall logs <br><br>' . (string) $output;
            } catch (\Exception $e) {
            }
        });

        $this->app->run();
    }
}
