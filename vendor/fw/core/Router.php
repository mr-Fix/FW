<?php

namespace fw\core;

/**
 * Класс маршрутизатора
 */
class Router
{
  /**
  * Таблица маршрутов
  * @var array
  */
  protected static $routes = [];

  /**
  * Текущий маршрут
  * @var array
  */
  protected static $route = [];

  /**
  * Добавляет маршрут в таблицу маршрутов
  * @param string $regexp - регулярное вырадение маршрута
  * @param array $route - маршрут ([controller, action, params])
  * @return void
  */
  public static function add($regexp, $route = []){
    self::$routes[$regexp] = $route;
  }

  /**
  * возвращает таблицу маршрутов
  * @return array
  */
  public static function getRoutes(){
    return self::$routes;
  }

  /**
  * возвращает текущий маршрут (controller, action, [params])
  * @return array
  */
  public static function getRoute(){
    return self::$route;
  }

  /**
  * ищет URL в таблице маршрутов
  * @param string $url - входящий URL
  * @return boolean
  */
  protected static function matchRoute($url){
    foreach(self::$routes as $pattern => $route){
      if( preg_match("#$pattern#i", $url, $matches) ){
        foreach($matches as $k => $v){
          if(is_string($k)){
            $route[$k] = $v;
          }
        }
        if( !isset($route['action']) ){
          $route['action'] = 'index';
        }
        // получаем префикс для админских контроллеров
        if( !isset($route['prefix']) ){
          $route['prefix'] = '';
        }else{
          $route['prefix'] .= '\\';
        }
        $route['controller'] = self::upperCamelCase($route['controller']);
        self::$route = $route;
        // debug($route);
        return true;
      }
    }
    return false;
  }

  /**
  * перенаправляет URL по корректному маршруту
  * @param string $url - входящий URL
  * @return void
  */
  public static function dispatch($url){
    $url = self::removeQueryString($url);
    if( self::matchRoute($url) ){
      $controller = 'app\controllers\\'. self::$route['prefix'] . self::$route['controller'] . 'Controller';
      if(class_exists($controller)){
        $cObj = new $controller(self::$route);
        $action = self::lowerCamelCase(self::$route['action']) . 'Action';
        if( method_exists($cObj, $action) ){
          $cObj->$action();
          $cObj->getView();
        }else {
          throw new \Exception("Метод <b>$controller::$action</b> не найден!", 404);
        }
      }else{
        throw new \Exception("Контроллер <b>$controller</b> не найден!", 404);
      }
    }else{
      throw new \Exception("Старница не найдена!", 404);
    }
  }

  /**
  * Переводит строку в CamelCase убирая из нее тире
  * @param string $name
  * @return string
  */
  protected static function upperCamelCase($name){
    // $name = str_replace('-', ' ', $name);
    // $name = ucwords($name);
    // $name = str_replace(' ', '', $name);
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
  }


  /**
  * Переводит первый символ в lowerCase
  * @param string $name
  * @return string
  */
  protected static function lowerCamelCase($name){
    return lcfirst(self::upperCamelCase($name));
  }

  /**
  * Отделяет запрос от get параметров
  * @param string $url
  * @return string
  */
  protected static function removeQueryString($url){
    if($url){
      $params = explode('&', $url, 2);
      if( false === strpos($params[0], '=') ){
        return rtrim($params[0], '/');
      }else{
        return '';
      }
    }
  }
}
