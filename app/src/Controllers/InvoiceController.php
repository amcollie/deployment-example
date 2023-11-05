<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\InvoiceService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class InvoiceController
{
    public function __construct(private readonly Twig $twig, private InvoiceService $invoiceService) {}

    public function index(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->twig->render(
            $response,
            'invoices/index.twig', 
            ['invoices' => $this->invoiceService->getPaidInvoices()]
        );
    }
}