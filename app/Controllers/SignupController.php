<?php namespace App\Controllers;

use App\Models\User;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */
class SignupController extends \App\Controller
{
  function __construct($app)
  {
      parent::__construct($app);

      $this->app->get('/signup', [ $this, 'render' ]);

      $this->app->post('/signup', [ $this, 'signup' ]);

      $this->app->router()->run();
  }

  function render()
  {
      return $this->template->render('signup/signup.twig');
  }

  function signup()
  {
      
  }
}
