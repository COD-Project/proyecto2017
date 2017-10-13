<?php namespace App\Models;

/**
 * @author Lucas Di Cunzolo
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
        "apartamentTypeId" => "tipo_vivienda_id",
        "heatingTypeId" => "tipo_calefaccion_id",
        "waterTypeId" => "tipo_agua_id"
    ];

    function apartamentType()
    {
        if ($this->apartamentTypeId()) {
            return ApartamentType::find($this->apartamentTypeId());
        }
    }

    function heatingType()
    {
        if ($this->heatingTypeId()) {
            return HeatingType::find($this->heatingTypeId());
        }
    }

    function waterType()
    {
        if ($this->waterTypeId()) {
            return WaterType::find($this->waterTypeId());
        }
    }
}
