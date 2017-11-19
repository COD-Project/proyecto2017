<?php namespace App\Controllers;

use App\Models\User;
use App\Models\Role;
use Mbh\Collection;
use Mbh\Helpers\Functions;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class UsersController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->app->get('/users', [ $this, 'indexAction' ]);
        $this->app->get('/users/search/:active', [ $this, 'indexAction' ]);
        $this->app->get('/users/search/:active/:username', [ $this, 'indexAction' ]);
        $this->app->get('/users/show/:username', [ $this, 'showAction' ]);
        $this->app->get('/users/disable/:id', [ $this, 'disableAction' ]);
        $this->app->get('/users/enable/:id', [ $this, 'enableAction' ]);
        $this->app->post('/users/edit/:id', [ $this, 'editAction' ]);
        $this->app->post('/users/edit/:id/roles', [ $this, 'editRolesAction' ]);

        $this->app->run();
    }

    public function indexAction($active = 'active', $username = null)
    {
        $this->checkPermissions([ 'usuario_index' ]);

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
            'users' => $users ? array_slice($users, $from, AMOUNT_PER_PAGE) : [],
            'page' => !$get['page'] ? 1 : $get['page'],
            'last_page' => ceil(count($users) / AMOUNT_PER_PAGE),
            'location' => "users/search/$active" . (!$username ? "" : "/$username")
        ]);
    }

    public function showAction($username)
    {
        if (!(
          $this->session->isLoggedIn()
          && $this->session->sessionInUse()->name() == $username
        )) {
            $this->checkPermissions([ 'usuario_show' ]);
        }

        User::init();
        $users = new Collection(User::findBy($username, 'name', 1));

        if (!$users->count()) {
            $this->redirect("error/404");
            return;
        }

        return $this->template->render('user/user.twig', [
            'user' => $users->get(0),
            'roles' => Role::all()
        ]);
    }

    public function editAction($id)
    {
        if (!(
          $this->session->isLoggedIn()
          && $this->session->sessionInUse()->name() == $username
        )) {
            $this->checkPermissions([ 'usuario_update' ]);
        }

        $post = $this->post();
        $user = User::find($id);

        try {
            $user->addState([
              'updatedAt' => date("Y-m-d H:i:s"),
              'name' => $post['username'],
              'firstName' => $post['firstName'],
              'lastName' => $post['lastName'],
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

    public function editRolesAction($id)
    {
        $this->checkPermissions([ 'usuario_update' ]);

        try {
            $post = $this->post();

            $user = User::find($id);
            if (count($post['roles']) > 0) {
                $db = new \App\Connection\Connection;

                $db->delete("usuario_tiene_roles", "usuario_id={$user->id()}", "");

                foreach ($post['roles'] as $key => $role) {
                    if (!Role::find($role)) {
                        throw new \Exception("El rol ingresado no es válido.");
                    }

                    $db->insert('usuario_tiene_roles', [
                      'usuario_id' => $user->id(),
                      'rol_id' => $role
                    ]);
                }
            }

            $this->redirect("users/show/{$user->name()}?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("?success=false&message={$e->getMessage()}");
        }
    }

    public function disableAction($id)
    {
        $this->checkPermissions([ 'usuario_destroy' ]);

        $user = User::find($id);

        if ($user) {
            $user->remove();
            $this->redirect("users?success=true&message=La operación fue realizada con éxito");
        } else {
            $this->redirect("?success=false&message=La operación no fue realizada con éxito");
        }
    }

    public function enableAction($id)
    {
        $this->checkPermissions([ 'usuario_new' ]);

        $user = User::find($id);

        if ($user) {
            $user->addState([
              'active' => '1'
            ]);

            $user->edit();
            $this->redirect("users?success=true&message=La operación fue realizada con éxito");
        } else {
            $this->redirect("?success=false&message=La operación no fue realizada con éxito");
        }
    }
}
