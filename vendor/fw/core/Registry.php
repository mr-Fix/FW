<?php

namespace fw\core;
/**
 * Класс для автоматической инициализации объектов и осуществления доступа к ним.
 */
class Registry
{

  use TSingletone;

  /**
  * Свойство для хранения объектов
  * @var array
  */
  public static $objects = [];



  protected function __construct()
  {
    require_once ROOT . '/config/config.php';
    foreach($config['components'] as $name => $component){
      self::$objects[$name] = new $component;
    }
  }

  /**
  * Проверка на существование и возврат запрошенного объекта из self::$objects
  * @param string $name - имя объекта
  * @return object
  */
  public function __get($name){
    if( is_object(self::$objects[$name]) ){
      return self::$objects[$name];
    }
  }

  /**
  * Проверка на существование и создание если такого объекта если его нет в self::$objects
  * @param string $name - имя объекта
  * @param object $object - класс объекта
  * @return void
  */
  public function __set($name, $object){
    if( !isset(self::$objects[$name]) ){
      self::$objects[$name] = new $object;
    }
  }

  /**
  * Функция для распечатки self::$objects
  * @return void
  */
  public function getList(){
    echo '<pre>';
    var_dump(self::$objects);
    echo '</pre>';
  }

  /**
  * Статическое свойство для хранения настроек
  * @var array
  */
  protected static $properties = [];

  /**
  * Метод для записи в массив self::$properties
  * @param string $name - ключ
  * @param mixed $value - значение
  * @return void
  */
  public function setProperty($name, $value){
    self::$properties[$name] = $value;
  }

  /**
  * Метод для записи в массив self::$properties
  * @param string $name - ключ
  * @return mixed|null
  */
  public function getProperty($name){
    if( isset(self::$properties[$name]) ){
      return self::$properties[$name];
    }
    return null;
  }

  /**
  * Функция для распечатки self::$properties
  * @return void
  */
  public function getProperties(){
    // echo '<pre>';
    debug(self::$properties);
    // echo '</pre>';
  }

}
