<?php

namespace vendor\core;
/**
* Реализует функционал singletone
*/
trait TSingletone
{

  /**
  * Хранит объект
  * @var object
  */
  protected static $instance;

  /**
  * Проверяет есть ли объект в свойстве self::$instance и возвращает, или создает и возвращает
  * @return object self::$instance
  */
  public static function instance(){
    if(self::$instance === null){
      self::$instance = new self;
    }
    return self::$instance;
  }
}
