<?php namespace App\Models;

/**
 * created by Lucas Di Cunzolo
 */

class Patient extends \App\Model
{
    protected static $table = [
        "name" => "pacientes",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "lastName" => "apellido",
        "firstName" => "nombre",
        "address" => "domicilio",
        "phone" => "telefono",
        "birthday" => "fecha_nac",
        "gender" => "genero",
        "demographicDataId" => "datos_demograficos_id",
        "socialWorkId" => "obra_social_id",
        "documentTypeId" => "tipo_doc_id",
        "documentNumber" => "numero_doc"
      ];

    public function demographicData()
    {
        if ($this->demographicDataId()) {
            return DemograpichData::find($this->demographicDataId());
        }
    }

    public function socialWork()
    {
        if ($this->socialWorkId()) {
            return SocialWork::find($this->socialWorkId());
        }
    }

    public function documentType()
    {
        if ($this->documentTypeId()) {
            return DocumentType::find($this->documentTypeId());
        }
    }

    public function fullName()
    {
        return "{$this->firstName()} {$this->lastName()}";
    }
}
