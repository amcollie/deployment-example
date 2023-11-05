<?php

declare(strict_types = 1);

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = require dirname(__DIR__) . '/configs/bootstrap.php';
$container = $app->getContainer();

(require CONFIG_PATH . '/routes.php')($app);

$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

$app->run();