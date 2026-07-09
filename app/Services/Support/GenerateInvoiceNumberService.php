<?php

namespace App\Services\Support;

use App\Models\Invoice;

class GenerateInvoiceNumberService
{
    public function handle(): string
    {
        $year = now()->format('Y');
        $month = now()->format('m');

        $prefix = "INV/{$year}/{$month}/";

        $lastInvoice = Invoice::query()
            ->where('invoice_number', 'like', "{$prefix}%")
            ->orderByDesc('invoice_number')
            ->first();

        $nextNumber = 1;

        if ($lastInvoice) {
            $lastSequence = (int) substr($lastInvoice->invoice_number, -3);
            $nextNumber = $lastSequence + 1;
        }

        return sprintf(
            '%s%03d',
            $prefix,
            $nextNumber
        );
    }
}