<?php

namespace App\Services\InvoiceItem;

use App\Models\InvoiceItem;

class UpdateInvoiceItemService
{
    public function handle(
        InvoiceItem $invoiceItem,
        array $attributes,
    ): InvoiceItem {
        $invoiceItem->update($attributes);

        return $invoiceItem->fresh();
    }
}