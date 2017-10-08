<?php namespace App\Controllers;

use App\Models\User;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class SignupController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app);

        $this->app->get('/signup', [ $this, 'render' ]);

        $this->app->post('/signup', [ $this, 'signup' ]);

        $this->app->router()->run();
    }

    public function render()
    {
        return $this->template->render('signup/signup.twig');
    }

    public function signup()
    {
        $post = $this->post();
        $e = [];

        User::init();
        $user = new User([
          'name' => $post['username'],
          'email' => $post['email'],
          'password' => $post['password']
          /* Include data here */
        ]);

        return $e;
    }
}
