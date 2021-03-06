<?php namespace App;

use Twig_Environment;
use Twig_Loader_Filesystem;
use App\Config;
use App\Models\Setting;

/**
 * @author Ulises J. Cornejo Fandos
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

    public function __construct($app = null, $sessionRules = [], $permissions = [])
    {
        parent::__construct($app);

        $this->defineSettingConstants();

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

        if (isset($sessionRules['unlogged']) && $sessionRules['unlogged'] == true && $this->session->isLoggedIn()) {
            $this->redirect();
        }

        if (isset($sessionRules['logged']) && $sessionRules['logged'] == true && !$this->session->isLoggedIn()) {
            $this->redirect();
        }

        $this->checkPermissions($permissions);

        /**
         * Templates settings
         *
         */
        $this->template = new Twig_Environment(new Twig_Loader_Filesystem('./web/templates/'));

        $this->template->addGlobal('app', [
            'url' => URL,
            'name' => APP_NAME,
            'amount_per_page' => AMOUNT_PER_PAGE,
            'description' => DESCRIPTION,
            'maintenance' => MAINTENANCE,
            'contact' => CONTACT
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
            $this->template->addGlobal('permissions', $this->currentPermissions());
            $this->template->addGlobal('roles', $this->currentRoles());
            $this->template->addGlobal('admin', $connectedUser->hasRole('Administrador'));
        }
    }

    protected function defineSettingConstants()
    {
        $settings = Setting::all();
        Config::defineSettingConstants(!$settings ? $settings : $settings[count($settings) - 1]->data());
    }

    protected function checkRoles($roles = [])
    {
        if ($this->session->checkRoles($roles)) {
            $this->redirect("error/403");
        }
    }

    protected function checkPermissions($permissions = [])
    {
        if (!$this->session->checkPermissions($permissions)) {
            $this->redirect("error/403");
        }
    }

    protected function currentRoles()
    {
        return $this->session->currentRoles();
    }

    protected function currentPermissions()
    {
        return $this->session->currentPermissions();
    }

    protected function redirect($url = "")
    {
        header('location:' . URL . $url);
        exit;
    }

    protected function get()
    {
        return $this->app->getRouter()->get();
    }

    protected function post()
    {
        return $this->app->getRouter()->post();
    }

    public function __destruct()
    {
        $this->model = null;
    }
}
