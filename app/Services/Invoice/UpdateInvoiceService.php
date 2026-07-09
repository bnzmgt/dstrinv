<?php

namespace App\Services\Invoice;

use App\Models\Invoice;

class UpdateInvoiceService
{
    public function handle(
        Invoice $invoice,
        array $attributes,
    ): Invoice {
        $invoice->update($attributes);

        return $invoice->fresh();
    }
}