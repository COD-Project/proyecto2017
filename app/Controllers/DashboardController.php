<?php namespace App\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Permission;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class DashboardController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $users = User::all();
        $patients = Patient::all();
        $roles = Role::all();
        $permissions = Permission::all();

        echo $this->template->render('dashboard/dashboard.twig', [
          'users_count' => count($users),
          'patients_count' => count($patients),
          'roles_count' => count($roles),
          'permissions_count' => count($permissions)
        ]);
    }
}
