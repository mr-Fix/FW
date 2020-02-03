<?php

namespace app\controllers\admin;
use vendor\core\base\View;
/**
 *
 */
class UserController extends AppController
{

  public function indexAction(){
    View::setMeta('Админка : : Главня страница', 'Описание админки', 'Ключевые админки');
    $test = 'Тестовая переменная';
    // $this->set([
    //   'test' => $test,
    // ]);
    $this->set( compact('test') );
  }
  public function testAction(){

  }
}
