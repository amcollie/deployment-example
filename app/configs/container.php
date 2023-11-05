<?php

declare(strict_types = 1);

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(require dirname(__DIR__) . '/configs/container_bindings.php');

return $containerBuilder->build();