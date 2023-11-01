<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $invoice_number
 * @property float $amount
 * @property InvoiceStatus $status
 * @property Carbon $created_at
 * @property Carbon $due_date
 * 
 * @property-read Collection $items
 */
class Invoice extends Model
{
    const UPDATED_AT = null;

    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
        'status' => InvoiceStatus::class,
    ];

    protected static function booted()
    {
        static::creating(function(Invoice $invoice) {
            if ($invoice->isClean()) {
                $invoice->due_date = (new Carbon())->addDays(10);
            }
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}