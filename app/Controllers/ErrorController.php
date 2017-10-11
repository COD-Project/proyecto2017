<?php namespace App\Controllers;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class ErrorController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        $this->template = new \Twig_Environment(new \Twig_Loader_Filesystem('./web/public/'));

        $this->app->get('/error', function($template) {
            return $template->render('error/404.twig');
        }, [$this->template]);

        $this->app->get('/error/:code', function($template, $code) {
            if (in_array($code, [404, 403, 301, 302])) {
                return $template->render("error/$code.twig");
            }

            $this->redirect("error/404");
        }, [$this->template]);

        $this->app->router()->run();
    }
}
