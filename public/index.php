<?php
error_reporting(-1);
use vendor\core\Router;

 $query = ltrim($_SERVER['REQUEST_URI'], '/');
echo $query = rtrim($query, '/');
// echo $query = $_SERVER['QUERY_STRING'];

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('CORE', dirname(__DIR__) . '/vendor/core');


// require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
// require '../app/controllers/Main.php';

spl_autoload_register(function($class){
  $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
  if( is_file($file) ){
    require_once $file;
  }
});



// default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getRoutes());

Router::dispatch($query);
