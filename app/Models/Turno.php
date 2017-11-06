<?php namespace App\Models;

/**
 * @author Ulises J. Cornejo Fandos
 */
class Turno extends \App\Model
{
    protected static $table = [
        "name" => "turnos",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "date" => "fecha",
        "documentNumber" => "numero_doc"
    ];
}
