<?php

declare(strict_types=1);

use Slim\App;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;

return function (App $app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/invoices', [InvoiceController::class, 'index']);
};