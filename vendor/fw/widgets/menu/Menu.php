<?php

namespace fw\widgets\menu;

use fw\core\App;
/**
 * Класс виджета меню
 */
class Menu
{

  /**
  * Массив даных из БД для построения меню. Одномерный.
  * @var array
  */
  protected $data;

  /**
  * Массив (многомерный) даных построеный в дерево.
  * @var array
  */
  protected $tree;

  /**
  * Html код меню в виде строки
  * @var string
  */
  protected $menuHtml;

  /**
  * путь к шаблону для построения html кода меню
  * @var string
  */
  protected $tpl = __DIR__ . '/menu_tpl/menu.php';

  /**
  * Тег в который обворачивается меню.
  * @var string
  */
  protected $container = 'ul';

  /**
  * CSS класс контейнера меню
  */
  protected $class = 'menu';
  /**
  * Таблица из которой выбираются данные.
  * @var string
  */
  protected $table = 'categories';

  /**
  * Отвечает за время кеширования меню.
  * @var int
  */
  protected $cache = 3600;

  /**
  * Ключ в имени кеша.
  * @var string
  */
  protected $cacheKey = 'fw_menu';

  public function __construct($options =[])
  {
    $this->getOptions($options);
    $this->run();
  }

  /**
  * Метод для установки значений отличных от значений по умолчанию
  *
  * @param array $options массив с параметрами
  * @return void
  */
  protected function getOptions($options){
    foreach($options as $k => $v){
      if( property_exists($this, $k) ){
        $this->$k = $v;
      }
    }
  }

  /**
  * Метод для вывода построенного меню
  * @return void
  */
  protected function output(){
    echo "<{$this->container} class='{$this->class}'>";
      echo $this->menuHtml;
    echo "</{$this->container}>";
  }

  /**
  * Запускает все методы для построения меню.
  * @return void
  */
  protected function run(){
    $this->menuHtml = App::$app->cache->get($this->cacheKey);
    if($this->menuHtml === false){
      $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
      $this->tree = $this->getTree();
      $this->menuHtml = $this->getMenuHtml($this->tree);
      App::$app->cache->set($this->cacheKey, $this->menuHtml, $this->cache);
    }
    $this->output();
  }

  /**
  * Строит дерево и массива
  * @return array
  */
  protected function getTree(){
    $tree = [];
    $data = $this->data;
    foreach($data as $id=>&$node) {
        if(!$node['parent']) {
            $tree[$id] = &$node;
        }else{
            $data[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
  }

  /**
  * Строит строку с кодом меню
  * @param array $tree -  массив дерево с пунктами меню
  * @param string $tab - отступ для влоденых пунктов меню
  * @return string
  */
  protected function getMenuHtml($tree, $tab = ''){
    $str = '';
    foreach($tree as $id => $category){
      $str .= $this->catToTemplate($category, $tab, $id);
    }
    return $str;
  }

  /**
  * Подключает шаблон меню и переддает в него данные
  * @param array $category -  массив с данными о пункте пунктами меню
  * @param string $tab - отступ для влоденых пунктов меню
  * @param int  $id - идентификатор меню
  * @return string
  */
  protected function catToTemplate($category, $tab, $id){
    ob_start();
    require $this->tpl;
    return ob_get_clean();
  }
}
