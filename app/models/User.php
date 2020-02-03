<?php

namespace app\models;

use fw\core\base\Model;
/**
 *
 */
class User extends Model
{
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
}
