<?php namespace App\Models;

/**
 * created by Juan Cruz Ocampos
 */

class Permission extends \App\Model
{
    protected static $table = [
        "name" => "permisos",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "name" => "nombre"
    ];
}
