<?php namespace App\Controllers;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class ErrorController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        $this->template = new \Twig_Environment(new \Twig_Loader_Filesystem('./web/public/'));

        $this->template->addGlobal('app', [
            'url' => URL,
            'name' => APP_NAME
        ]);

        $this->app->get('/error', function($template) {
            return $template->render('error/404.twig');
        }, [$this->template]);

        $this->app->get('/error/:code', function($template, $code) {
            if (in_array($code, [404, 403, 301, 302, 500])) {
                return $template->render("error/$code.twig");
            }

            $this->redirect("error/404");
        }, [$this->template]);

        $this->app->router()->run();
    }
}
