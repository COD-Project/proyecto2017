<?php namespace App\Models;

/**
 * created by Lucas Di Cunzolo
 */

class SocialWork extends \App\Model
{
    protected static $table = [
        "name" => "obras_sociales",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "name" => "nombre"
    ];
}
