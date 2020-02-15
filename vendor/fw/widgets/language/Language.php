<?php

namespace fw\widgets\language;

use fw\core\App;
/**
 *
 */
class Language
{
  /**
  * Путь к шаблону
  * @var string
  */
  protected $tpl;

 /**
 * Список языков
 * @var array
 */
  protected $languages;

 /**
 * Активный язык
 * @var array
 */
  protected $language;


  public function __construct()
  {
    $this->tpl = __DIR__ . '/lang_tpl.php';
    $this->run();
  }

  protected function run(){
    $this->languages = App::$app->getProperty('langs');
    $this->language = App::$app->getProperty('lang');
    echo $this->getHtml();
  }

  /**
  * Возвращает список всех языков из БД
  * @return array
  */
  public static function getLanguages(){
    return \R::getAssoc("SELECT code, title, base FROM languages ORDER BY base ASC");
  }

  /**
  * Возвращает активный язык
  * @param array $languages
  * @return array
  */
  public static function getLanguage($languages){
    if( isset($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], $languages) ){
      $key = $_COOKIE['lang'];
    }else{
      $key = key($languages);
    }
    $lang = $languages[$key];
    $lang['code'] = $key;
    return $lang;
  }

  /**
  * Возвращает html код вывода языков
  * @return string
  */
  protected function getHtml(){
    ob_start();
    require_once $this->tpl;
    return ob_get_clean();
  }
}
