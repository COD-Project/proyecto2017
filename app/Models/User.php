<?php namespace App\Models;

/**
 * created by Lucas Di Cunzolo
 */

class User extends \App\Model
{
    protected static $table = [
        "name" => "usuarios",
        "idColumn" => "id"
    ];

    protected static $columnData = [
        "id" => "id",
        "email" => "email",
        "name" => "username",
        "firstName" => "first_name",
        "lastName" => "last_name",
        "password" => "password",
        "active" => "activo",
        "createdAt" => "created_at",
        "updatedAt" => "updated_at",
        "session" => "session"
    ];

    public static function create($data = [])
    {
        if (count(static::findBy($data['name'], 'name')) > 0) {
            throw new \Exception("El nombre de usuario ingresado corresponde a otro usuario.");
        } elseif (count(static::findBy($data['email'], 'email')) > 0) {
            throw new \Exception("El email ingresado corresponde a otro usuario.");
        }

        return parent::create($data);
    }

    public function roles()
    {
        return [];
    }

    public function fullName()
    {
        return "{$this->firstName()} {$this->lastName()}";
    }
}
