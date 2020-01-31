<?php

use vendor\core\Router;

 $query = $_SERVER['REQUEST_URI'];
$query = ltrim($_SERVER['REQUEST_URI'], '/');
echo $query = rtrim($query, '/');
echo '<br>';
// echo $query = $_SERVER['QUERY_STRING'];
echo '<br>';

define('DEBUG', 1);
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('CORE', dirname(__DIR__) . '/vendor/core');
define('LAYOUT', 'default');
define('LIBS', dirname(__DIR__) . '/vendor/libs');
define('CASHE', dirname(__DIR__) . '/tmp/cashe');


require '../vendor/libs/functions.php';


spl_autoload_register(function($class){
  $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
  if( is_file($file) ){
    require_once $file;
  }
});
new \vendor\core\App;

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getRoutes());

Router::dispatch($query);
