<?php

namespace app\controllers;

use fw\core\base\View;
use app\models\User;
/**
 *
 */
class UserController extends AppController
{

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

  public function loginAction(){

  }

  public function logoutAction(){

  }

}
