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
        try {
            $post = $this->post();
            User::init();

            $user = User::create([
              'name' => $post['username'],
              'firstName' => $post['username'],
              'lastName' => $post['username'],
              'email' => $post['email'],
              'password' => $post['password'],
              'active' => "1",
              'createdAt' => date("Y-m-d H:i:s"),
              'updatedAt' => date("Y-m-d H:i:s")
            ]);

            $this->session->generateSession($user->id());

            return [
              'success' => true,
              'message' => "La operación fué realizada con éxito."
            ];
        } catch (\Exception $e) {
            return [
              'success' => false,
              'message' => $e->getMessage()
            ];
        }
    }
}
