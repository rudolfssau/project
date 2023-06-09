<?php
require __DIR__ . './../vendor/autoload.php';
use Main\Core\Router;
use Main\Core\Error;
/**
 * Error reporting for front controller
 */
error_reporting(E_ALL);
set_exception_handler('Main\Core\Error::errorHandler');
set_exception_handler('Main\Core\Error::exceptionHandler');
/**
 * Routing
 */
$router = new Router();
$router->add('/', ['controller' => 'Home', 'action' => 'show']);
$router->add('/test', ['controller' => 'Home', 'action' => 'test']);
$router->add('/home/delete', ['controller' => 'Home', 'action' => 'delete']);
$router->add('/check/check', ['controller' => 'Check', 'action' => 'check']);
$router->add('/favicon.ico', ['controller' => 'Favicon', 'action' => 'main']);
$router->add('/addproducts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('/posts/insert', ['controller' => 'Posts', 'action' => 'insert']);
$router->add('/get/returnJson', ['controller' => 'Get', 'action' => 'returnJson']);
$router->add('{controller}/{id:\d+}/{action}');
$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);