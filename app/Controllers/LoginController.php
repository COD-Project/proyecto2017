<?php namespace App\Controllers;

use Mbh\Helpers\Functions;
use Mbh\Collection;
use \App\Models\User;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class LoginController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app, [
          'unlogged' => true
        ]);

        $this->app->get('/login', [ $this, 'render' ]);

        $this->app->post('/login', [ $this, 'login' ]);

        $this->app->router()->run();
    }

    function render()
    {
        return $this->template->render('login/login.twig');
    }

    function login()
    {
        $post = $this->post();
        $e = [];

        User::init();

        $user = new User([
            'name' => $post['username'],
            'password' => Functions::encrypt($post['password'])
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