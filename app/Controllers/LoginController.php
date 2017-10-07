<?php namespace App\Controllers;

use Mbh\Helpers\Functions;
use \App\Models\User;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class LoginController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        $app->get('/login', [ $this, 'render' ]);

        $app->post('/login', [ $this, 'login' ]);

        $app->router()->run();
    }

    function render()
    {
        return $this->template->render('login/login.twig');
    }

    function login()
    {
        $post = $this->post();

        User::init();
        $user = new User([
            'email' => $post['email'],
            'password' => $post['password']
        ]);

        $e = [];

        if ($user->exists()) {
            $session->generateSession($user->id());
        }

        return $e;
    }
}
