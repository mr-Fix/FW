<?php
error_reporting(-1);
use vendor\core\Router;

 // echo $query = $_SERVER['REQUEST_URI'];
 // echo $query = ltrim($_SERVER['REQUEST_URI'], '/');
// $query = rtrim($query, '/');
echo '<br>';
$query = $_SERVER['QUERY_STRING'];
echo '<br>';

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('CORE', dirname(__DIR__) . '/vendor/core');
define('LAYOUT', 'default');
define('LIBS', dirname(__DIR__) . '/vendor/libs');

// require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
// require '../app/controllers/Main.php';

spl_autoload_register(function($class){
  $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
  if( is_file($file) ){
    require_once $file;
  }
});

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);


// default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getRoutes());

Router::dispatch($query);
