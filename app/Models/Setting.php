<?php namespace App\Models;

/**
 * @author Ulises J. Cornejo Fandos
 */

class Setting extends \App\Model
{
    protected static $table = [
        "name" => "configuraciones",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "appName" => "nombre_app",
        "amountPerPage" => "cantidad_por_pagina",
        "contact" => "mail_contacto",
        "description" => "descripcion",
        "userId" => "usuario_id",
        "maintenance" => "mantenimiento",
        "createdAt" => "created_at"
    ];

    public function user()
    {
        return User::find($this->userId());
    }

    public function data()
    {
        return [
            "name" => $this->appName(),
            "description" => $this->description(),
            "contact" => $this->contact(),
            "amount_per_page" => $this->amountPerPage(),
            "maintenance" => $this->maintenance()
        ];
    }
}
