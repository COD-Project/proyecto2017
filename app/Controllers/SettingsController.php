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

        $this->configFile = new File("uploads/settings.json");

        $this->app->get('/settings', [ $this, 'notFound' ]);
        $this->app->get('/settings/:method', [ $this, 'notFound' ]);
        $this->app->post('/settings/edit', [ $this, 'edit' ]);

        $this->app->router()->run();
    }

    public function notFound()
    {
        $this->redirect("error/404");
    }

    public function edit()
    {
        try {
            $post = $this->post();

            $data = json_decode($this->configFile->content(), true);

            $data = array_merge($data, [
              'name' => $post['name'],
              'description' => $post['description'],
              'amount_per_page' => $post['amount_per_page'],
              'maintenance' => (bool) ($post['maintenance'] == 'on')
          ]);

            $this->configFile->write(json_encode($data));

            $this->redirect("dashboard?success=true&message=La operación fué realizada con éxito.");
        } catch (\Exception $e) {
            $this->redirect("dashboard?success=false&message={$e->getMessage()}");
        }
    }
}
