<?php namespace App\Models;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class HealthControl extends \App\Model
{
    protected static $table = [
        "name" => "controles_de_salud",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "date" => "fecha",
        "weight" => "peso",
        "completeVaccines" => "vacunas_completas",
        "vaccinesObservations" => "vacunas_observaciones",
        "accordingMaturationContext" => "maduracion_acorde",
        "maturationObservations" => "maduracion_observacion",
        "commonPhysicalExamination" => "ex_fisico_normal",
        "physicalExaminationObservations" => "ex_fisico_observaciones",
        "pc" => "pc",
        "ppc" => "ppc",
        "height" => "talla",
        "feeding" => "alimentacion",
        "generalObservations" => "observaciones_generales",
        "patientId" => "paciente_id",
        "userId" => "user_id"
    ];

    public function patient()
    {
        if ($this->patientId()) {
            return Patient::find($this->patientId());
        }
    }

    public function user()
    {
        if ($this->userId()) {
            return User::find($this->userId());
        }
    }
}
