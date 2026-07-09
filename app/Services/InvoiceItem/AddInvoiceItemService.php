<?php

namespace App\Services\InvoiceItem;

use App\Models\Invoice;
use App\Models\InvoiceItem;

class AddInvoiceItemService
{
    public function handle(
        Invoice $invoice,
        array $attributes,
    ): InvoiceItem {
        return $invoice->items()->create($attributes);
    }
}