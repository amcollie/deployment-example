<?php

declare(strict_types=1);

namespace App;

/**
 * @property-read ?array $db
 * @property-read ?string $environment
 */
class Config
{
    public array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'],
                'user' => $env['DB_USER'],
                'password' => $env['DB_PASS'],
                'dbname' => $env['DB_NAME'],
                'driver' => $env['DB_DRIVER'] ?? 'pdo_mysql',
            ],
            'mailer' => [
                'dsn' => $env['EMAIL_DSN'] ?? '',
            ],
            'apiKeys' => [
                'emailable' => $env['EMAILABLE_API_KEY'] ?? '',
                'abstractApi' => $env['ABSTRACT_API_KEY'] ?? '',
            ],
            'environment' => $env['ENVIRONMENT'] ?? 'production',
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}