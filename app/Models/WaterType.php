<?php namespace App\Models;

/**
 * created by Lucas Di Cunzolo
 */

class WaterType extends \App\Model
{
    protected static $table = [
        "name" => "tipo_agua",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "name" => "nombre"
    ];
}
