<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DeleteInvoiceService
{
    public function handle(
        Invoice $invoice,
    ): bool {
        return DB::transaction(function () use ($invoice) {
            return $invoice->delete();
        });
    }
}