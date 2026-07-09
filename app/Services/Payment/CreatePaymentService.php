<?php

namespace App\Services\Payment;

use App\Models\Invoice;
use App\Models\Payment;

class CreatePaymentService
{
    public function handle(
        Invoice $invoice,
        array $attributes,
    ): Payment {
        return $invoice->payments()->create($attributes);
    }
}