<?php

use fw\core\Router;

 $query = $_SERVER['REQUEST_URI'];
$query = ltrim($_SERVER['REQUEST_URI'], '/');
$query = rtrim($query, '/');
// echo '<br>';
// echo $query = $_SERVER['QUERY_STRING'];
// echo '<br>';

define('DEBUG', 1);
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('CORE', dirname(__DIR__) . '/vendor/fw/core');
define('LAYOUT', 'blog');
define('LIBS', dirname(__DIR__) . '/vendor/fw/libs');
define('CACHE', dirname(__DIR__) . '/tmp/cache');


require_once '../vendor/fw/libs/functions.php';
require_once __DIR__ . '/../vendor/autoload.php';

// spl_autoload_register(function($class){
//   $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
//   if( is_file($file) ){
//     require_once $file;
//   }
// });
new fw\core\App;

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// default routes
Router::add('^admin$', ['controller' => 'User', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);


Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getRoutes());

Router::dispatch($query);
