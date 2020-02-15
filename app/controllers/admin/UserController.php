<?php

namespace app\controllers\admin;
use fw\core\base\View;
use app\models\User;
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
  public function loginAction(){
    if(!empty($_POST)){
      $user = new User();
      if( !$user->login(true) ){
        $_SESSION['error'] = 'Логин/пароль введены неверно!';
      }
      if(User::isAdmin()){
        redirect(ADMIN);
      }else{
        redirect();
      }
    }
    $this->layout = 'login';
  }
}
