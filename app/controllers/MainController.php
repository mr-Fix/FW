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
    $posts = \R::findAll('posts');
    // debug($data);
    $this->set(compact('posts'));
  }

}
