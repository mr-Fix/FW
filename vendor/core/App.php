<?php

namespace vendor\core;

use vendor\core\Registry;
/**
 *
 */
class App
{

  public static $app;

  function __construct()
  {
    self::$app = Registry::instance();
  }
}
