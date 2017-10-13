<?php namespace App\Models;

/**
 * @author Lucas Di Cunzolo
 */

class HeatingType extends \App\Model
{
    protected static $table = [
        "name" => "tipo_calefaccion",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "name" => "nombre"
    ];
}
