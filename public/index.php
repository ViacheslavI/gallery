<?php

use vendor\core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');
/**
 * 0 - продакшин
 * 1 - девелопмент
 */
define('DEBUG', 1);

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('LAYOUT', 'default');
define('USER','http://gallery.local');
define('ADMIN','http://gallery.local/admin');

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});
new \vendor\core\App();


/**
 * My rule route
 */
Router::add('^pages/?(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Main']); // полный адрес строки
Router::add('^pages/(?P<alias>[0-9a-z-]+)$', ['controller' => 'View', 'action' => 'index']);  // адрес с параметром (сокращенный)
Router::add('^delete/(?P<alias>[0-9]+)$', ['controller' => 'Cabinet', 'action' => 'delete']);

/**
 * Default rule route
 */
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);



Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::add('^(?P<alias>[a-z-]+)$', ['controller' => 'Cabinet', 'action' => 'delete']);
Router::dispatch($query);

?>
