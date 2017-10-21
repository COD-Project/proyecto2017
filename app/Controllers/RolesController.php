<?php namespace App\Controllers;

use App\Models\Role;
use App\Models\Permission;

/**
 * @author Lucas Di Cunzolo
 */

class RolesController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->app->get('/roles', [ $this, 'render']);
        $this->app->get('/roles/show/:id', [ $this, 'show']);
        $this->app->get('/roles/create', [ $this, 'add']);
        $this->app->post('/roles/create', [ $this, 'createRole' ]);
        $this->app->post('/roles/edit/:id', [ $this, 'edit']);
        $this->app->get('/roles/delete/:id', [ $this, 'delete' ]);
        $this->app->get('/roles/delete/:id/:permission_name', [ $this, 'deletePermission' ]);

        $this->app->run();
    }

    public function render()
    {
        $this->checkPermissions([ 'rol_index' ]);
        $get = $this->get();

        Role::init();
        $pageNumber = !$get['page'] ? $get['page'] : $get['page'] - 1;
        $from = AMOUNT_PER_PAGE * (int) $pageNumber;

        $roles = Role::all();

        return $this->template->render('roles/roles.twig', [
            'roles' => $roles ? array_slice($roles, $from, AMOUNT_PER_PAGE) : [],
            'page' => !$get['page'] ? 1 : $get['page'],
            'last_page' => ceil(count($roles) / AMOUNT_PER_PAGE)
        ]);
    }

    public function show($id)
    {
        $this->checkPermissions([ 'rol_show' ]);
        $get = $this->get();

        Role::init();
        $pageNumber = !$get['page'] ? $get['page'] : $get['page'] - 1;
        $from = AMOUNT_PER_PAGE * (int) $pageNumber;

        $role = Role::find($id);
        $permissions = $role->permissions();

        if ($role) {
            return $this->template->render('role/show.twig', [
                'role' => $role,
                'permissions' => $permissions ? array_slice($permissions, $from, AMOUNT_PER_PAGE) : [],
                'page' => !$get['page'] ? 1 : $get['page'],
                'last_page' => ceil(count($permissions) / AMOUNT_PER_PAGE),
                'notPermissions' => $role->permissionsComplement()
            ]);
        }

        $this->redirect("error/404");
    }

    public function add()
    {
        $this->checkPermissions([ 'rol_new' ]);

        Role::init();
        return $this->template->render('role/create.twig', [
            "permissions" => Permission::all()
        ]);
    }

    public function createRole()
    {
        $this->checkPermissions([ 'rol_new' ]);

        try {
            $post = $this->post();
            Role::init();
            $role = Role::create([
                'name' => $post['name']
            ]);
            if (count($post['permissionsId']) > 0) {
              $db = new \App\Connection\Connection;
              foreach ($post['permissionsId'] as $key => $permission) {
                  if (!Permission::find($permission)) {
                      throw new \Exception("Permiso no encontrado", 1);
                  }
                  $db->insert('rol_tiene_permisos', [
                      'rol_id' => $role->id(),
                      'permiso_id' => $permission
                  ]);
              }
            }
            $this->redirect("roles/show/{$role->id()}?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("?success=false&message={$e->getMessage()}");
        }
    }

    public function edit($id)
    {
        $this->checkPermissions([ 'rol_update' ]);
        try {
            $post = $this->post();
            Role::init();
            $role = Role::find($id);
            $role->addState([
                'name' => $post['name']
            ]);
            $role->edit();
            if (count($post['permissionsId']) > 0) {
              $db = new \App\Connection\Connection;
              foreach ($post['permissionsId'] as $key => $permission) {
                  if (!Permission::find($permission)) {
                      throw new \Exception("Permiso no encontrado", 1);
                  }
                  $db->insert('rol_tiene_permisos', [
                      'rol_id' => $role->id(),
                      'permiso_id' => $permission
                  ]);
              }
            }
            $this->redirect("roles/show/{$role->id()}?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("?success=false&message={$e->getMessage()}");
        }
    }

    public function delete($id)
    {
        $this->checkPermissions([ 'rol_destroy' ]);
        try {
            Role::init();
            $role = Role::find($id);
            if ($role) {
                $role->remove();
            }
            $this->redirect("roles?success=true&message=La operación fue realizada con éxito");
          } catch (\Exception $e) {
              $this->redirect("?success=false&message={$e->getMessage()}");
          }
    }

    public function deletePermission($role_id, $permission)
    {
        $this->checkPermissions([ 'rol_destroy' ]);
        try {
            Role::init();
            $role = Role::find($role_id);
            $permission = Permission::findBy($permission, 'name')[0];
            if ($role) {
                $role->removePermission($permission);
            }
            $this->redirect("roles/show/{$role->id()}?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("?success=false&message={$e->getMessage()}");
        }
    }
}
