<?php namespace App;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * created by Ulises J. Cornejo Fandos
 */
class Controller extends \Mbh\Controller
{
    public static function create($controller, $args)
    {
        $className = "\\App\\Controllers\\" . ucwords($controller) . "Controller";
        if (class_exists($className)) {
            return parent::create($className, $args);
        }

        header('location:' . URL . 'error');
    }

    public function __construct($app = null)
    {
        parent::__construct($app);

        /**
         * Templates settings
         *
         */
        $this->template = new Twig_Environment(new Twig_Loader_Filesystem('./web/templates/'));

        $this->template->addGlobal('app', [
            'url' => URL,
            'name' => "Hospital Gutiérrez"
        ]);

        /**
         * @var Sessions
         *
         */
         Storage\Session::init();
         $this->session = new Storage\Session();

         $this->session->checkLife();
    }

    protected function redirect($url = "")
    {
         header('location:' . URL . $url);
    }

    public function __destruct()
    {
        $this->model = null;
    }
}
