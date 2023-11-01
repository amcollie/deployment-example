<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use Twig\Environment;

class InvoiceController
{
    public function  __construct(private Environment $twig)
    {

    }

    #[Get('/invoices')]
    public function index(): string
    {
        $invoices = Invoice::query()
            ->where('status', InvoiceStatus::PAID)
            ->get()
            ->map(
                fn(Invoice $invoice) => [
                    'invoiceNumber' => $invoice->invoice_number,
                    'amount'        => $invoice->amount,
                    'status'        => $invoice->status->toString(),
                    'dueDate'       => $invoice->due_date->toDateTimeString(),
                ]
            )
            ->toArray();

        // echo '<pre>';
        // var_dump($invoices);
        // echo '</pre>';

        return $this->twig->render(
            'invoices/index.twig', 
            compact('invoices')
        );
    }

    // public function create(): View
    // {
    //     return View::make('invoices/create');
    // }

    // #[Post('/invoices')]
    // public function store()
    // {
    //     CsvFile::upload();

    //     $invoices = [];

    //     $csvFiles = CsvFile::getFiles(UPLOAD_PATH);

    //     foreach ($csvFiles as $csvFile) {
    //         $data = array_merge($invoices, CsvFile::readFiles(UPLOAD_PATH, $csvFile, '\App\Models\CsvFile::extractInvoice'));
    //         $invoices = $data;
    //     }
        
    //     $invoice = new Invoice();

    //     foreach ($invoices as $invoiceRow) {
    //         $invoice->create(
    //             $invoiceRow['tx_date'],
    //             $invoiceRow['check_no'],
    //             $invoiceRow['description'],
    //             $invoiceRow['amount']
    //         );
    //     }

    //     header('Location: /invoices');
    //     die();
    // }
}