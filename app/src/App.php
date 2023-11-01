<?php

declare(strict_types = 1);

namespace App;

use App\Contracts\EmailValidationInterface;
use App\Contracts\PaymentGatewayInterface;
use App\Exceptions\RouteNotFoundException;
use App\Router;
use App\Services\AbstractApi\EmailValidationService;
// use App\Services\Emailable\EmailValidationService;
use App\Services\PaddlePayment;
use App\View;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;
use Twig\Loader\FilesystemLoader;


class App
{
    private Config $config;

    public function __construct(
        protected Container $container,
        protected ?Router $router = null, 
        protected array $request = [], 
    )
    {
    }

    public function initDb(array $config): void
    {
        $capsule = new Capsule();

        $capsule->addConnection($config);

        $capsule->setEventDispatcher(new Dispatcher($this->container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function boot(): static
    {
        \Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();

        $this->config = new Config($_ENV);

        $this->initDb($this->config->db);

        $loader = new FilesystemLoader(VIEW_PATH);
        $twig = new Environment($loader, [
            'cache' => STORAGE_PATH . '/cache',
            'auto_reload' => true,
        ]);

        $twig->addExtension(new IntlExtension());

        $this->container->bind(
            PaymentGatewayInterface::class,
            PaddlePayment::class
        );

        $this->container->bind(
            MailerInterface::class, 
            fn() => new CustomMailer($this->config->mailer['dsn'])
        );

        $this->container->singleton(Environment::class, fn ()  => $twig);

        $this->container->bind(
            EmailValidationInterface::class, 
            fn() => new EmailValidationService($this->config->apiKeys['abstractApi'])
        );

        // $this->container->bind(
        //     EmailValidationInterface::class, 
        //     fn() => new EmailValidationService($this->config->apiKeys['emailable'])
        // );

        return $this;
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve(
                strtolower($this->request['method']), 
                $this->request['uri']
            );
        } catch (RouteNotFoundException $e) {
            http_response_code(404);
            echo View::make('error/404');
        }
    
    }
}