<?php

require __DIR__ . './../vendor/autoload.php';

use Main\Core\Router;
use Main\Core\Error;

/**
 * Error reporting for front controller
 */
error_reporting(E_ALL);
set_exception_handler('Main\Core\Error::exceptionHandler');

/**
 * Routing presets
 */
$router = new Router();
$router->add('/', ['controller' => 'Home', 'action' => 'show']);
$router->add('/home/delete', ['controller' => 'Home', 'action' => 'delete']);
$router->add('/check/check', ['controller' => 'Check', 'action' => 'check']);
$router->add('/addproducts', ['controller' => 'Products', 'action' => 'index']);
$router->add('/posts/insert', ['controller' => 'Products', 'action' => 'insert']);
$router->add('/get/returnJson', ['controller' => 'Get', 'action' => 'returnJson']);
$router->add('{controller}/{id:\d+}/{action}');
try {
    $router->dispatch($_SERVER['REQUEST_URI']);
} catch (Exception $ex) {
    return $ex;
}