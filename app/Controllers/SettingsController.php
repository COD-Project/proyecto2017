<?php namespace App\Controllers;

use App\Storage\File;

/**
 * @author Ulises J. Cornejo Fandos
 */
class SettingsController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app);

        $this->configFile = new File("uploads/config.json");
        $this->controllersFile = new File("uploads/controllers.json");

        $this->app->get('/settings', [ $this, 'notFound' ]);
        $this->app->get('/settings/:method', [ $this, 'notFound' ]);
        $this->app->post('/settings/:method', function($controller, $method) {
            if (!method_exists($controller, $method)) {
                $controller->redirect("error/404");
            }

        }, [ $this ]);

        $this->app->router()->run();
    }

    public function notFound()
    {
        $this->redirect("error/404");
    }
}
