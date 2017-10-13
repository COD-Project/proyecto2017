<?php namespace App\Models;

/**
 * @author Lucas Di Cunzolo
 */

class ApartamentType extends \App\Model
{
    protected static $table = [
        "name" => "tipo_vivienda",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "name" => "nombre"
    ];
}
