<?php

namespace app\models;

use fw\core\base\Model;
/**
 *
 */
class User extends Model
{
  /**
  * Содежит маску полей формы
  * @var array
  */
  public $attributes = [
    'login' => '',
    'password' => '',
    'email' => '',
    'name' => '',
  ];
  /**
  * Определяем правила для валидации форм
  * @var array
  */
  public $rules = [
    'required' => [
      ['login'],
      ['password'],
      ['email'],
      ['name'],
    ],
    'email' => [
      ['email'],
    ],
    'lengthMin' => [
      ['password, 6'],
    ]
  ];

  /**
  * Метод проверяет логи и email на дублирование при регистрации пользователя
  * @return bool
  */
  public function checkUnique(){
    $user = \R::findOne('user', 'login = ? OR email = ? LIMIT 1', [$this->attributes['login'], $this->attributes['email']]);
    if($user){
      if($user->login == $this->attributes['login']){
        $this->errors['unique'][] = 'Этот логин уже занят!';
      }
      if($user->email == $this->attributes['email']){
        $this->errors['unique'][] = 'Этот email уже занят!';
      }
      return false;
    }
    return true;
  }

  /**
  * Метод авторизации пользователя
  * @return bool
  */
  public function login($isAdmin = false){
    $login = !empty( trim($_POST['login']) ) ? trim($_POST['login']) : null;
    $password = !empty( trim($_POST['password']) ) ? trim($_POST['password']) : null;
    if($login && $password){
      if($isAdmin){
        $user = \R::findOne('user', "login = ? AND role = 'admin' LIMIT 1", [$login]);
      }else{
        $user = \R::findOne('user', 'login = ? LIMIT 1', [$login]);
      }
      if($user){
        if( password_verify($password, $user->password) ){
          foreach($user as $k => $v){
            if($k != 'password'){
              $_SESSION['user'][$k] = $v;
            }
          }
          return true;
        }
      }
    }
    return false;
  }

  public static function isAdmin(){
    return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
  }
}
