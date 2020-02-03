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
define('CACHE', dirname(__DIR__) . '/tmp/cache');


require '../vendor/libs/functions.php';


spl_autoload_register(function($class){
  $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
  if( is_file($file) ){
    require_once $file;
  }
});
new \vendor\core\App;
// $cashe = \vendor\core\App::$app->cache->get('menu_select');


Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// default routes
Router::add('^admin$', ['controller' => 'User', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);


Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getRoutes());

Router::dispatch($query);
