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
        "userId" => "user_id",
        "active" => "activo"
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

    public function age()
    {
        $birthday = new \DateTime($this->patient()->birthday());
        $interval = $birthday->diff(new \DateTime($this->date()), true);
        return (int) ($interval->format("%a")/7);
    }

    public function remove()
    {
        $this->addState([
            "active" => "0"
        ]);

        $this->edit();

        return $this;
    }
}
