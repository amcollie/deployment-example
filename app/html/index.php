<?php

declare(strict_types = 1);

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Router;
use App\App;
use Illuminate\Container\Container;
use App\Controllers\CurlController;

require_once dirname(__DIR__) . '/vendor/autoload.php';

session_start();

define('STORAGE_PATH', dirname(__DIR__) . '/storage');
define('UPLOAD_PATH', STORAGE_PATH . '/uploads');
define('VIEW_PATH', dirname(__DIR__) . '/views');

$container = new Container();
$router = new Router($container);
$router->registerRoutesFromControllerAttributes([
    HomeController::class,
    InvoiceController::class,
    CurlController::class,
]);

// echo '<pre>';
// print_r($router->routes());
// echo '</pre>';


(new App(
    $container,
    $router,
    [
        'uri' => $_SERVER['REQUEST_URI'],
        'method' => $_SERVER['REQUEST_METHOD']
    ],
))
    ->boot()
    ->run();