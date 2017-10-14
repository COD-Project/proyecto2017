<?php namespace App\Models;

use Mbh\Collection;

/**
 * @author Lucas Di Cunzolo
 */

class User extends \App\Model
{
    protected static $table = [
        "name" => "usuarios",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "email" => "email",
        "name" => "username",
        "firstName" => "first_name",
        "lastName" => "last_name",
        "password" => "password",
        "active" => "activo",
        "createdAt" => "created_at",
        "updatedAt" => "updated_at",
        "session" => "session"
    ];

    public static function create($data = [])
    {
        if (count(static::findBy($data['name'], 'name')) > 0) {
            throw new \Exception("El nombre de usuario ingresado corresponde a otro usuario.");
        } elseif (count(static::findBy($data['email'], 'email')) > 0) {
            throw new \Exception("El email ingresado corresponde a otro usuario.");
        }

        $data = array_merge($data, [
          "active" => "1",
          "createdAt" => date("Y-m-d H:i:s"),
          "updatedAt" => date("Y-m-d H:i:s")
        ]);

        return parent::create($data);
    }

    public function remove()
    {
        $this->addState([
          "active" => "0"
        ]);

        $this->edit();

        return $this;
    }

    public function fullName()
    {
        return "{$this->firstName()} {$this->lastName()}";
    }

    public function roles()
    {
        $select = "*";
        $from = "usuario_tiene_roles";
        $where = "usuario_id=" . $this->id();
        $userRoles = static::$db->select($select, $from, $where);

        Role::init();

        return array_map(function ($userRole) {
            return Role::find($userRole['rol_id']);
        }, $userRoles);
    }

    public function hasRole($role)
    {
        Role::init();

        if (is_string($role)) {
            $role = (new Collection(Role::findBy($role, 'name')))->get(0);
        }

        $result = array_filter($this->roles(), function ($each) use ($role) {
            return $each->equals($role);
        });

        return count($result) > 0;
    }

    public function hasPermission($permission)
    {
        Permission::init();

        if (is_string($permission)) {
            $permission = (new Collection(Permission::findBy($permission, 'name')))->get(0);
        }

        $result = array_filter($this->permissions(), function ($each) use ($permission) {
            return $each->equals($permission);
        });

        return count($result) > 0;
    }

    public function permissions()
    {
        $roles = $this->roles();

        $permissions = [];

        foreach ($roles as $key => $role) {
            foreach ($role->permissions() as $key => $value) {
                $permissions[] = $value;
            }
        }

        return array_values($permissions);
    }

    public function permissionsComplement()
    {
        Permission::init();
        $permissions = $this->permissions();
        $all_permissions = Permission::all();
        return array_udiff($all_permissions, $permissions, function($x, $y){
            $x_id = $x->id();
            $y_id = $y->id();

            if ($x_id < $y_id) {
                return -1;
            } elseif ($x_id > $y_id) {
                return 1;
            } else {
                return 0;
            }
          });
    }

    public function rolesAsStringArray()
    {
        $roles = [];

        foreach ($this->roles() as $key => $role) {
            if (!in_array($role->name(), $roles)) {
                $roles[] = $role->name();
            }
        }

        return $roles;
    }

    public function permissionsAsStringArray()
    {
        $permissions = [];

        foreach ($this->permissions() as $key => $permission) {
            if (!in_array($permission->name(), $permissions)) {
                $permissions[] = $permission->name();
            }
        }

        return $permissions;
    }
}
