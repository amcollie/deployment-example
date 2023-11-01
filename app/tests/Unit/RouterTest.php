<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router();
    }


    /** @test */
    public function itRegistersRoute(): void
    {
        $this->router->register('get', '/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index']
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function itRegistersGetRoute(): void{
        $this->router->get('/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index']
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function itRegistersPostRoute(): void
    {
        $this->router->post('/users', ['Users', 'store']);

        $expected = [
            'post' => [
                '/users' => ['Users', 'store']
            ],
        ];

        $this->assertSame($expected, $this->router->routes());
    }

    /** @test */
    public function thereAreNoRoutesWhenRouterCreated(): void
    {
        $this->router = new Router();

        $this->assertEmpty($this->router->routes());
    }

    /** 
     * @test 
     * @dataProvider \Tests\DataProvider\RouterDataProvider::routeNotFoundCases
     * */
    public function itThrowsRouteNotFoundException(
        string $requestUri,
        string $requestMethod
    ): void
    {
        $users = new class() {
            public function delete(): bool
            {
                return true;
            }
        };

        $this->router->post('/users', [$users::class, 'store']);
        $this->router->get('/users', [$users::class, 'index']);

        $this->expectException(RouteNotFoundException::class);

        $this->router->resolve($requestUri, $requestMethod);
    }

    /** @test */
    public function itResolveRouteFromClosure(): void
    {
        $this->router->get('/users', fn () => [1, 2, 3]);

        $this->assertSame([1, 2, 3], $this->router->resolve('get', '/users'));
    }

    /** @test */
    public function itResolveRouteFromArray(): void{
        $users = new class() {
            public function index(): array
            {
                return [1, 2, 3];
            }
        };

        $this->router->get('/users', [$users::class, 'index']);

        $this->assertSame([1, 2, 3], $this->router->resolve('get', '/users'));
    }
}