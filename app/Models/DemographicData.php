<?php namespace App\Models;

/**
 * created by Lucas Di Cunzolo
 */

class DemographicData extends \App\Model
{
    protected static $table = [
        "name" => "datos_demograficos",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "refrigerator" => "heladera",
        "electricity" => "electricidad",
        "pet" => "mascota",
        "apartament_type_id" => "tipo_vivienda_id",
        "heating_type_id" => "tipo_calefaccion_id",
        "water_type_id" => "tipo_agua_id"
    ];
}
