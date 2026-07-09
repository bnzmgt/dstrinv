<?php

namespace App\Services\Payment;

use App\Models\Payment;

class DeletePaymentService
{
    public function handle(
        Payment $payment,
    ): bool {
        return $payment->delete();
    }
}