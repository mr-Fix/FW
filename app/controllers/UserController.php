<?php

namespace app\controllers;

use fw\core\base\View;
use app\models\User;
/**
 *
 */
class UserController extends AppController
{

  /**
  * Метод регистрации учетной записи
  * @return void
  */
  public function signupAction(){
    if( !empty($_POST) ){
      $user = new User();
      $data = $_POST;
      $user->load($data);

      if( !$user->validate($data) || !$user->checkUnique() ){
        $user->getErrors();
        $_SESSION['form_data'] = $data;
        redirect();
      }

      $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);

      if( $user->save('user') ){
        $_SESSION['success'] = 'Вы успешно зарегистрировались';
      }else{
        $_SESSION['error'] = 'Ошибка! Попробуйте позже!';
      }
      redirect();
    }

    View::setMeta('Регистрация');
  }

  /**
  * Метод входа в учетную запись
  * @return void
  */
  public function loginAction(){
    if( !empty($_POST) ){
      $user = new User();
      if( $user->login() ){
        $_SESSION['success'] = 'Вы успешно авторизованы';
      }else{
        $_SESSION['error'] = 'Логин/пароль введены неверно!';
      }
      redirect();
    }
    View::setMeta('Вход');
  }

 /**
 * Метод выхода из учетной записи
 * @return void
 */
  public function logoutAction(){
    if( isset($_SESSION['user']) ){
      unset($_SESSION['user']);
      redirect();
    }
  }

}
