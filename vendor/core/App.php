<?php

namespace vendor\core;

use vendor\core\Registry;
use vendor\core\ErrorHandler;

/**
 * Класс для создания объекта реестра
 */
class App
{
  /**
  * Объект реестра
  * @var object
  */
  public static $app;

  function __construct()
  {
    self::$app = Registry::instance();
    new ErrorHandler();
  }
}
