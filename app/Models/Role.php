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

    public function remove()
    {
        static::$db->delete("rol_tiene_permisos", "rol_id={$this->id()}", "LIMIT " . count($this->permissions()));
        $this->delete("id={$this->id()}");
        return $this;
    }
}
