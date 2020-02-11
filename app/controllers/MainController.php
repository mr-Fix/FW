<?php
namespace app\controllers;
use app\models\Main;
use fw\core\App;
use fw\core\base\View;
/**
 *
 */
class MainController extends AppController
{
  //public $layout = 'main';

  public function indexAction(){

    $model = new Main;
    $posts = \R::findAll('posts');
    View::setMeta('Главная страница', 'Описание страницы', 'Ключевык слова');
    $this->set(compact('posts'));
  }
  
  public function testAction(){
    if( $this->isAjax() ){
      $model = new Main();
      $post = \R::findOne('posts', "id = {$_POST['id']}");
      $this->loadView('test', compact('post'));
      die;
    }
  }

}
