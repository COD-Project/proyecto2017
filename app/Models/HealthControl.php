<?php namespace App\Models;

/**
 * @author Lucas Di Cunzolo
 */

class HealthControl extends \App\Model
{
    protected static $table = [
        "name" => "controles_de_salud",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "age" => "edad",
        "date" => "fecha",
        "weight" => "peso",
        "completeVaccines" => "vacunas_completas",
        "maturationChord" => "maduracion_acorde",
        "exCommonPhysicist" => "ex_fisico_comun",
        "exPhysicistObservations" => "ex_fisico_observaciones",
        "pc" => "pc",
        "ppc" => "ppc",
        "height" => "talla",
        "feeding" => "alimentacion",
        "generalObservations" => "observaciones_generales",
        "patientId" => "paciente_id",
        "userId" => "user_id"
    ];

    function patient()
    {
        if ($this->patientId()) {
            return Patient::find($this->patientId());
        }
    }

    function user()
    {
        if ($this->userId()) {
            return User::find($this->userId());
        }
    }
}
