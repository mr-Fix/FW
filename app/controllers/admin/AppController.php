<?php

namespace app\controllers\admin;
use fw\core\base\Controller;
use app\models\User;

/**
 *
 */
class AppController extends Controller
{
  public $layout = 'admin';

  function __construct($route)
  {
    parent::__construct($route);
    if( !User::isAdmin() && $route['action'] != 'login'){
      redirect(ADMIN . '/user/login');
    }
  }

}
