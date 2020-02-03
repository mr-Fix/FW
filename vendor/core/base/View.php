<?php
namespace vendor\core\base;

/**
 * Базовый view/ Подключает и отдает шаблоны и view. Также передает параметры внутрь view
 * Сожержит методы переноса скриптов js вниз шаблона из view
 */
class View
{

  /**
  * текущий маршрут и параметры (controller, action, params)
  * @var array
  */
   public $route = [];

  /**
  * текущий view
  * @var string
  */
  public $view;

  /**
  * текущий шаблон
  * @var string
  */
   public $layout;

  /**
  * все скрипты из view (результат работы метода getScripts)
  * @var array
  */
   public $scripts = [];

   /**
   * Статическое свойство для проброса метаинформации о страницы в view
   * @var array
   */
   public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];


  public function __construct($route, $layout = '', $view = '')
  {
    $this->route = $route;
    if(false === $layout){
      $this->layout = false;
    }else{
      $this->layout = $layout ?: LAYOUT;
    }
    $this->view = $view;
  }

  /**
  * Подключает шаблон, view. Передает в view даные. Перердает view в шаблон.
  *
  * @var array $vars - массив с переменными
  * @return void
  */
  public function render($vars){
    if( is_array($vars) ){
      extract($vars);
    }

    $file_view = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";

    ob_start();
    if(is_file($file_view)){
      require $file_view;
    }else{
      throw new \Exception("<p>Не найден вид <b>{$file_view}</b></p>", 404);
      // echo "<p>Не найден вид <b>{$file_view}</b></p>";
    }
    $content = ob_get_clean();

    if(false !== $this->layout){
      $file_layout = APP . "/views/layouts/{$this->layout}.php";
      if(is_file($file_layout)){
        $content = $this->getScripts($content);
        $scripts = [];
        if( !empty($this->scripts[0]) ){
          $scripts = $this->scripts[0];
        }
        require $file_layout;
      }else{
        throw new \Exception("<p>Не найден шаблон <b>{$file_layout}</b></p>", 404);

        // echo "<p>Не найден шаблон <b>{$file_layout}</b></p>";
      }
    }
  }

  /**
  * Ищет js код в view и вырезает его.
  *
  * @param string $content - весь текст из view
  * @return string $content - весь текст view без скриптов js
  */
  protected function getScripts($content){
    $pattern = "#<script.*?>.*?</script>#si";
    preg_match_all($pattern, $content, $this->scripts);
    if( !empty($this->scripts) ){
      $content = preg_replace($pattern, '', $content);
    }
    return $content;
  }

  /**
  * Выводит метаданные на страницу (title, keywords, description)
  *
  * @return void
  */
  public static function getMeta(){
    echo '<title>' . self::$meta['title'] . '</title>
    <meta name="description" content="' . self::$meta['desc'] . '">
    <meta name="keywords" content="' . self::$meta['keywords'] . '">';
  }
  /**
  * Записывает метаданные в статическое свойство self::$meta (title, keywords, description)
  *
  * @param string $title - Заголовок страницы
  * @param string $desc - Описание
  * @param string $keywords - Ключевые слова для страницы
  * @return void
  */
  public static function setMeta($title = '', $desc = '', $keywords = ''){
    self::$meta['title'] = $title;
    self::$meta['desc'] = $desc;
    self::$meta['keywords'] = $keywords;
  }
}
