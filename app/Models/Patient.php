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
        "genere" => "genero",
        "demographicDataId" => "datos_demograficos_id",
        "socialWorkId" => "obra_social_id",
        "documentTypeId" => "tipo_doc_id",
        "number" => "numero"
      ];

    function demographicData()
    {
        if ($this->demographicDataId()) {
            return DemograpichData::find($this->demographicDataId());
        }
    }

    function socialWork()
    {
        if ($this->socialWorkId()) {
            return SocialWork::find($this->socialWorkId());
        }
    }

    function documentType()
    {
        if ($this->documentTypeId()) {
            return DocumentType::find($this->documentTypeId());
        }
    }
}
