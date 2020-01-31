<?php
namespace vendor\core\base;

/**
 * Основной класс от которого наследуют остальные контроллеры. Содержит базовый функционал.
 */
abstract class Controller
{
 /**
 * текущий маршрут и параметры (controller, action, params)
 * @var array
 */
  public $route = [];

  /**
  * Вид который будет подключаться
  * @var string
  */
  public $view;

  /**
  * Шаблон страницы
  * @var string
  */
  public $layout;

  /**
  * Пользовательские данные для передачи в view
  * @var array
  */
  public $vars;

  public function __construct($route){
    $this->route = $route;
    $this->view = $route['action'];
  }

  /**
  * Запускает загрузку шаблона и вида
  *
  *@return void
  */
  public function getView(){
    $vObj = new View($this->route, $this->layout, $this->view);
    $vObj->render($this->vars);
  }
  /**
  * Сеттер для установки свойства $vars
  *
  * @param array $vars - данные для передачи в view
  * @return void
  */
  public function set($vars){
    $this->vars = $vars;
  }

  /**
  * Проверка запроса на Ajax
  *
  * @return bool true | false
  */
  public function isAjax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }

  /**
  * Выдача view при ajax
  *
  * @param string $view - имя view
  * @param array $vars - данные для передачи в view
  * @return void
  */
  public function loadView($view, $vars = []){
    extract($vars);
    require APP . "/views/{$this->route['controller']}/{$view}.php";
  }
}
