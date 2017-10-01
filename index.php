<?php

class App
{
    public static function __init()
    {
        define("ROOT", __DIR__);

        require_once ROOT . "/app/Config/Bootstrap.php";
        App\Bootstrap::init();
    }
}

App::__init();
