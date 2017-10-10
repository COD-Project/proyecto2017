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

    public function __construct($app = null, $permissions = [])
    {
        parent::__construct($app);

        /**
         * \Mbh\Router
         *
         */
        $this->app->setRouter(new \App\Router());

        /**
         * @var Sessions
         *
         */
        Storage\Session::init();
        $this->session = new Storage\Session();

        $this->session->checkLife();

        /**
         * Templates settings
         *
         */
        $this->template = new Twig_Environment(new Twig_Loader_Filesystem('./web/templates/'));

        $this->template->addGlobal('app', [
            'url' => URL,
            'name' => APP_NAME
        ]);

        $get = $this->get();

        $this->template->addGlobal('get', [
            'show' => isset($get['message']),
            'success' => $get['success'],
            'message' => $get['message']
        ]);

        if ($this->session->isLoggedIn()) {
            $connectedUser = $this->session->sessionInUse();
            $this->template->addGlobal('owner_user', $connectedUser);

            /*if ($this->session->isGranted()) {
                $this->template->addGlobal('admin', true);
            }*/
        }
    }

    protected function redirect($url = "")
    {
        header('location:' . URL . $url);
    }

    public function get()
    {
        return $this->app->getRouter()->get();
    }

    public function post()
    {
        return $this->app->getRouter()->post();
    }

    public function __destruct()
    {
        $this->model = null;
    }
}
