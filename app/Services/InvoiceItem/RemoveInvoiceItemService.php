<?php

namespace App\Services\InvoiceItem;

use App\Models\InvoiceItem;

class RemoveInvoiceItemService
{
    public function handle(
        InvoiceItem $invoiceItem,
    ): bool {
        return $invoiceItem->delete();
    }
}