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
        
    }
}
