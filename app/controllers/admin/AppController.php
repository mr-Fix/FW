<?php

namespace app\controllers\admin;
use fw\core\base\Controller;

/**
 *
 */
class AppController extends Controller
{
  public $layout = 'admin';

  function __construct($route)
  {
    parent::__construct($route);
  }
}
