<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/configs/path_constants.php';

\Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();

$container = require CONFIG_PATH . '/container.php';

AppFactory::setContainer($container);

return AppFactory::create();