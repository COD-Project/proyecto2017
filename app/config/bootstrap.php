<?php

class AppBootstrap
{
    /**
     * Init system
     *
     * Load all required files and setup configs.
     * @param boolean $runApp If false dont load app framework - false during tests
     * @return boolean true
     */
    public static function init($runApp = true)
    {
        // Base config file
        require_once ROOT . "/app/config/config.php";

        if ($runApp) {
            require ROOT . '/vendor/autoload.php';
            $app = new \Mbh\App;

            require_once ROOT . "/app/config/routes.php";
            $app->run();
        }

        return true ;
    }
}
