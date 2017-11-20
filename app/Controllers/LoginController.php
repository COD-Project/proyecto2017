<?php namespace App\Controllers;

use Mbh\Helpers\Functions;
use Mbh\Collection;
use \App\Models\User;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class LoginController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'unlogged' => true
        ]);

        $this->app->get('/login', [ $this, 'indexAction' ]);

        $this->app->post('/login', [ $this, 'loginAction' ]);

        $this->app->run();
    }

    public function indexAction()
    {
        return $this->template->render('login/login.twig');
    }

    public function loginAction()
    {
        $post = $this->post();
        $e = [];

        User::init();

        $user = new User([
            'name' => $post['username'],
            'password' => Functions::encrypt($post['password']),
            'active' => '1'
        ]);

        if ($user->exists()) {
            $user->refresh();
            $this->session->generateSession($user->id());
            $e = [
              'success' => true,
              'message' => 'La sesión se inició correctamente.'
            ];
        } else {
            $e = [
              'success' => false,
              'message' => 'El nombre de usuario y/o la contraseña son inválidos.'
            ];
        }

        return $e;
    }
}
