<?php

/**
* Распечатка массива в удобочитаемом виде. Обертка над print_r()
* @param array $arr - массив с данными для распчатки
*/
function debug($arr){
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

/**
* Функция редиректа пользователя
* @param bool $http alhtc для переадресации. по умолчание false
* @return void
*/
function redirect($http = false){
  if($http){
    $redirect = $http;
  }else{
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
  }
  header("Location: $redirect");
  die;
}

/**
* Функция обертка над htmlspecialchars короткое название
* @return string
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES);
}
