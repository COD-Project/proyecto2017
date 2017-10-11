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
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->app->get('/users', [ $this, 'render' ]);
        $this->app->get('/users/search/:active', [ $this, 'render' ]);
        $this->app->get('/users/search/:active/:username', [ $this, 'render' ]);
        $this->app->get('/users/show/:username', [ $this, 'show' ]);
        $this->app->get('/users/disable/:id', [ $this, 'disable' ]);
        $this->app->post('/users/edit/:id', [ $this, 'edit' ]);

        $this->app->router()->run();
    }

    public function render($active = 'active', $username = null)
    {
        $get = $this->get();

        if (isset($get['username']) || isset($get['active'])) {
            $username = $get['username'];
            $active = !$get['active'] ? $active : $get['active'];
            $this->redirect("users/search/$active" . (!$username ? "" : "/$username"));
        }

        return $this->search($active, $username);
    }

    public function search($active = 'active', $username = null)
    {
        $get = $this->get();
        User::init();

        $users = User::get([
            'name' => $username,
            'active' => (int) ($active == 'active')
        ]);

        $pageNumber = !$get['page'] ? $get['page'] : $get['page'] - 1;
        $from = AMOUNT_PER_PAGE * (int) $pageNumber;

        return $this->template->render('users/users.twig', [
            'users' => $users ? array_slice($users, $from, $delta) : [],
            'users_count' => count($users),
            'page' => !$get['page'] ? 1 : $get['page'],
            'last_page' => ceil(count($users) / AMOUNT_PER_PAGE),
            'location' => "users/search/$active" . (!$username ? "" : "/$username")
        ]);
    }

    public function show($username)
    {
        User::init();
        $users = new Collection(User::findBy($username, 'name', 1));
        return $this->template->render('user/user.twig', [
            'user' => $users->get(0)
        ]);
    }

    public function edit($id)
    {
        $post = $this->post();
        $user = User::find($id);

        try {
            $user->addState([
              'name' => $post['username'],
              'email' => $post['email'],
              'password' => !$post['password'] ?
                  $user->password() :
                  Functions::encrypt($post['password'])
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
            $this->redirect("users?success=true&message=La operación fue realizada con éxito");
        }
    }
}
