<?php
echo $query = ltrim($_SERVER['REQUEST_URI'], '/');
// echo $query = $_SERVER['QUERY_STRING'];
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

Router::add('posts/add', ['controller' => 'Post', 'action' => 'add']);
Router::add('posts', ['controller' => 'Post', 'action' => 'index']);
Router::add('', ['controller' => 'Main', 'action' => 'index']);

debug(Router::getRoutes());
if(Router::matchRoute($query)){
  debug(Router::getRoute());
}else{
  echo '404';
}
