<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'item_name',
        'description',
        'qty',
        'unit_price',
    ];

    protected function casts(): array
    {
        return [
            'qty' => 'decimal:2',
            'unit_price' => 'decimal:2',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn (): float => $this->qty * $this->unit_price,
        );
    }
}