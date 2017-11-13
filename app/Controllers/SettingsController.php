<?php namespace App\Controllers;

use App\Storage\File;
use App\Models\Setting;

/**
 * @author Ulises J. Cornejo Fandos
 */
class SettingsController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->app->get('/settings', [ $this, 'notFound' ]);
        $this->app->get('/settings/:method', [ $this, 'notFound' ]);
        $this->app->post('/settings/edit', [ $this, 'edit' ]);

        $this->app->run();
    }

    public function notFound()
    {
        $this->redirect("error/404");
    }

    public function edit()
    {
        try {
            $post = $this->post();

            Setting::init();

            Setting::create([
                'appName' => $post['name'],
                'description' => $post['description'],
                'contact' => $post['contact'],
                'amountPerPage' => $post['amount_per_page'],
                'maintenance' => (string) (int) ($post['maintenance'] == 'on'),
                'userId' => $this->session->sessionInUse()->id(),
                'createdAt' => date("Y-m-d H:i:s")
            ]);

            $this->redirect("dashboard?success=true&message=La operación fué realizada con éxito.");
        } catch (\Exception $e) {
            $this->redirect("dashboard?success=false&message={$e->getMessage()}");
        }
    }
}
