<?php

declare(strict_types=1);

use App\Models\Invoice;
use App\Enums\InvoiceStatus;
// use Illuminate\Support\Carbon;
use App\Models\InvoiceItem;
// use Illuminate\Database\Capsule\Manager as Capsule;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/eloquent.php';

// Capsule::connection()->transaction(function () {
//     $items = [
//         ['Item 1', 1, 15],
//         ['Item 2', 2, 7.5],
//         ['Item 3', 4, 3.75],
//     ];

//     $invoice = new Invoice();
//     $invoice->amount = 45;
//     $invoice->invoice_number = '1';
//     $invoice->status = InvoiceStatus::PENDING;
//     $invoice->due_date = (new Carbon())->addDays(10);
//     $invoice->save();
    
//     foreach($items as [$description, $quantity, $unitPrice]) {
//         $item = new InvoiceItem();
//         $item->description = $description;
//         $item->quantity = $quantity;
//         $item->unit_price = $unitPrice;
    
//         $item->invoice()->associate($invoice);
//         $item->save();
//     }
// });

// $invoiceId = 1;
// Invoice::query()->where('id', $invoiceId)->update(['status' => InvoiceStatus::PAID]);
Invoice::query()->where('status', InvoiceStatus::PAID)->get()->each(function (Invoice $invoice) {
    echo $invoice->id . ', ' . $invoice->status->toString() . ', ' . $invoice->created_at->format('Y-m-d H:i:s') . PHP_EOL;

    $invoice->items()->each(function (InvoiceItem $item) {
        echo ' - ' . $item->description . ', ' . $item->quantity . ', ' .  $item->unit_price . PHP_EOL;
    });
});