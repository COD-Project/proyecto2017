<?php namespace App\Models;

/**
 * @author Lucas Di Cunzolo
 */

class DocumentType extends \App\Model
{
    protected static $table = [
        "name" => "tipos_documento",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "name" => "nombre"
    ];
}
