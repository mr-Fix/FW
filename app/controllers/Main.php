<?php
namespace app\controllers;

/**
 *
 */
class Main extends App
{
  public $layout = 'main';

  public function indexAction(){
    // echo 'Main::index';
    $name = 'Андрей';
    $col = ['name' => $name, 'hi' => 'hello'];
    $this->set(compact('name'));
  }

}
