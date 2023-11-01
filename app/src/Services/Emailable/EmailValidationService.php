<?php

declare(strict_types=1);

namespace App\Services\Emailable;

use App\Contracts\EmailValidationInterface;
use App\DTO\EmailValidationResult;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class EmailValidationService implements EmailValidationInterface
{
    private string $baseUrl = 'https://api.emailable.com/v1/';

    public function __construct(private string $apiKey)
    {}

    public function verify(string $email): EmailValidationResult
    {
        $stack = HandlerStack::create();

        $maxRetries = 3;
        $stack->push($this->getRetryMiddleware($maxRetries));
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 5.0,
            'handler'  => $stack,
        ]);

        $params = [
            'api_key' => $this->apiKey,
            'email'=> $email,
        ];

        $response = $client->get('verify', ['query' => $params]);

        $body = json_decode($response->getBody()->getContents(), true);

        return new EmailValidationResult($body['score'], trim($body['state']) === 'deliverable');
    }

    private function getRetryMiddleware(int $maxRetries)
    {
        return Middleware::retry(
            function (
                int $retries, RequestInterface $request, 
                ?ResponseInterface $response = null, 
                ?RuntimeException $exception = null
            ) use ($maxRetries) {
                if ($retries >= $maxRetries) {
                    return false;
                }

                if ($response && in_array($response->getStatusCode(), [249, 429, 503])) {
                    return true;
                }

                if ($exception instanceof ConnectException) {
                    return true;
                }

                return false;
            }
        );
    }
}