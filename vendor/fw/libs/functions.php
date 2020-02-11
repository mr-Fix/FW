<?php

/**
* Распечатка массива в удобочитаемом виде
*/
function debug($arr){
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

/**
* Функция редиректа
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

function h($str){
  return htmlspecialchars($str, ENT_QUOTES);
}
