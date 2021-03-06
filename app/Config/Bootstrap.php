<?php namespace App;

class Bootstrap
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
        require_once ROOT . "/app/Config/Config.php";
        Config::init();

        if ($runApp) {
            require ROOT . '/vendor/autoload.php';
            static::register();

            $app = new \Mbh\App;

            require_once ROOT . "/app/Config/routes.php";

            $app->firewall()
                ->run();

            if (DEBUG) {
                $app->debug();
            }
        }

        return true ;
    }

    public static function autoload($class)
    {
        $prefix = __NAMESPACE__ . '\\';
        $length = strlen($prefix) - 1;
        $base_dir = ROOT . '/app/';

        if (strncmp($prefix, $class, $length) !== 0) {
            return;
        }


        $class_end = substr($class, $length);
        $file = $base_dir . str_replace('\\', '/', $class_end) . '.php';
        if (is_readable($file)) {
            require $file;
        }
    }

    public static function register()
    {
        spl_autoload_register(__NAMESPACE__ . "\\Bootstrap::autoload");
    }
}
