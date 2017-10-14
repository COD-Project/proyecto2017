<?php namespace App\Models;

/**
 * @author Juan Cruz Ocampos
 */

class Role extends \App\Model
{
    protected static $table = [
        "name" => "roles",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "name" => "nombre"
    ];

    public function permissions()
    {
        $select = "*";
        $from = "rol_tiene_permisos";
        $where =  "rol_id=" . $this->id();
        $rolePermissions = static::$db->select($select, $from, $where);

        Permission::init();

        return array_map(function ($rolePermission) {
            return Permission::find($rolePermission['permiso_id']);
        }, $rolePermissions);
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

    public function remove()
    {
        static::$db->delete("rol_tiene_permisos", "rol_id={$this->id()}", "LIMIT " . count($this->permissions()));
        $this->delete("id={$this->id()}");
        return $this;
    }

    public function removePermission($permission)
    {
        if (!($permission instanceof \App\Models\Permission)) {
            throw new \Exception("La operación no se pudo realizar con éxito");
        }
        static::$db->delete("rol_tiene_permisos", "rol_id={$this->id()} AND permiso_id={$permission->id()}");
        return $this;
    }
}
