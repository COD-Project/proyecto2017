<?php namespace App\Models;

/**
 * created by Lucas Di Cunzolo
 */

class User extends \Mbh\Model
{
    protected static $table = [
        "name" => "usuario",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "email" => "email",
        "name" => "username",
        "firstName" => "first_name",
        "lastName" => "last_name"
        "password" => "password",
        "activo" => "activo",
        "createdAt" => "created_at",
        "updatedAt" => "updated_at"
    ];
}
