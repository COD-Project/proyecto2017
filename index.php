<?php

class MyApp
{
    public static function __init()
    {
        define("ROOT", __DIR__);

        require_once ROOT . "/app/config/bootstrap.php";
        AppBootstrap::init();
    }
}

MyApp::__init() ;
