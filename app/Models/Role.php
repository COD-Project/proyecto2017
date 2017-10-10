<?php namespace App\Models;

/**
 * created by Juan Cruz Ocampos
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

    function permissions()
    {
        $select = "*";
        $from = "rol_tiene_permisos";
        $where =  "rol_id=" . $this->id();
        $rolePermissions = static::$db->select($select, $from, $where);

        Permission::init();

        $permissions = array_map(function($rolePermission){
          return Permission::find($rolePermission['permiso_id']);
        }, $rolePermissions);

        return $permissions;
    }
}
