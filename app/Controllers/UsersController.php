<?php namespace App\Controllers;

use App\Models\User;
use Mbh\Collection;
use Mbh\Helpers\Functions;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class UsersController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app);

        $this->app->get('/users', [ $this, 'render' ]);
        $this->app->get('/users/show/:username', [ $this, 'show' ]);
        $this->app->get('/users/disable/:id', [ $this, 'disable' ]);
        $this->app->post('/users/edit/:id', [ $this, 'edit' ]);

        $this->app->router()->run();
    }

    public function render()
    {
        User::init();
        $users = User::findBy(1, 'active');
        return $this->template->render('users/users.twig', [
          'users' => $users
        ]);
    }

    public function show($username)
    {
        User::init();
        $users = new Collection(User::findBy($username, 'name'));
        return $this->template->render('user/user.twig', [
            'user' => $users->get(0)
        ]);
    }

    public function get($username = null)
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

    public function edit($id)
    {
        $post = $this->post();
        $user = User::find($id);

        try {
            $user->addState([
              'name' => $post['username'],
              'email' => $post['email'],
              'password' => Functions::encrypt($post['password'])
            ]);

            $user->edit();
            $username = $user->name();

            $this->redirect("users/show/$username?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("users/show/$username?success=false&message={$e->getMessage()}");
        }
    }

    public function disable($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->remove();
        }
    }
}
