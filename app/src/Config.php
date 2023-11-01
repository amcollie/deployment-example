<?php

declare(strict_types=1);

namespace App;

class Config
{
    public array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'],
                'username' => $env['DB_USER'],
                'password' => $env['DB_PASS'],
                'database' => $env['DB_NAME'],
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ],
            'mailer' => [
                'dsn' => $env['EMAIL_DSN'] ?? '',
            ],
            'apiKeys' => [
                'emailable' => $env['EMAILABLE_API_KEY'] ?? '',
                'abstractApi' => $env['ABSTRACT_API_KEY'] ?? '',
            ],
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}