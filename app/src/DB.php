<?php

declare(strict_types = 1);

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DB
{
    private Connection $connection;

    public function __construct(array $config)
    {
        $this->connection = DriverManager::getConnection($config);
    }

    public function __call(string $method, array $args): mixed
    {
        return call_user_func_array([$this->connection, $method], $args);
    }
}