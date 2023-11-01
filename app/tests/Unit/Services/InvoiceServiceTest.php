<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    private InvoiceService $invoiceService;

    protected function setUp(): void
    {
        parent::setUp();

        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $gatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        $gatewayServiceMock->method("charge")->willReturn(true);
        $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->with(['name'=> 'Alex'], 'receipt');

        $this->invoiceService = new InvoiceService(
            $salesTaxServiceMock, 
            $gatewayServiceMock, 
            $emailServiceMock
        );
    }

    /** @test */
    public function itProcessesInvoice(): void
    {
        $customer = [
            'name' => 'Alex'
        ];

        $amount = 150;

        $result = $this->invoiceService->process($customer, $amount);

        $this->assertTrue($result);
    }

    /** @test */
    public function itsSendsReceiptEmailWhenInvoiceIsProcessed(): void
    {
        $customer = [
            'name' => 'Alex'
        ];

        $amount = 150;

        $result = $this->invoiceService->process($customer, $amount);

        $this->assertTrue($result);
    }
}