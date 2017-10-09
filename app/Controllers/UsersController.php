<?php namespace App\Controllers;

use App\Models\User;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class UsersController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        $this->app->get('/users', [ $this, 'render' ]);
        $this->app->get('/users/get', [ $this, 'get' ]);
        $this->app->get('/users/get/:username', [ $this, 'get' ]);
        $this->app->get('/users/disable/:id', [ $this, 'disable' ]);
        $this->app->post('/users/edit/:id', [ $this, 'edit' ]);

        $this->app->router()->run();
    }

    function render()
    {
        User::init();
        $users = User::findBy(1, 'active');
        return $this->template->render('users/users.twig', [
          'users' => $users
        ]);
    }

    function get($username = null)
    {
        User::init();
        $users = User::findBy($username, 'name');

        if (!$users) {
            return [];
        }

        return array_map(function ($user) {
            return [
                "username" => $user->name(),
                "email" => $user->email(),
                "firstName" => $user->firstName(),
                "lastName" => $user->lastName()
            ];
        }, $users);
    }

    function disable($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->remove();
        }
    }
}
