<?php

namespace app\controllers\admin;

/**
 *
 */
class TestController extends AppController
{

  public function indexAction(){
    echo 'Админка и индекс метод';
  }
  public function testAction(){
    echo 'Админка и тест метод';
  }
}
