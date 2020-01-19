<?php
namespace app\controllers;
use app\models\Main;
use vendor\core\App;
/**
 *
 */
class MainController extends AppController
{
  // public $layout = 'main';

  public function indexAction(){
    // App::$app->getList();
    $model = new Main;
    $posts = App::$app->cashe->get('posts');
    if(!$posts){
      $posts = \R::findAll('posts');
      App::$app->cashe->set('posts', $posts);
    }
    // debug($data);
    $this->set(compact('posts'));
  }

}
