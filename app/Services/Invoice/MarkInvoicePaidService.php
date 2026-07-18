<?php

namespace App\Services\Invoice;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceTimelineType;
use App\Models\Invoice;
use App\Models\User;
use App\Services\Timeline\CreateInvoiceTimelineService;
use DomainException;
use Illuminate\Support\Facades\DB;

class MarkInvoicePaidService
{
    public function __construct(
        protected CreateInvoiceTimelineService $timelineService,
    ) {
    }

    public function handle(
        Invoice $invoice,
        User $user,
    ): Invoice {
        if ($invoice->status !== InvoiceStatus::SENT) {
            throw new DomainException(
                'Only sent invoices can be marked as paid.'
            );
        }

        return DB::transaction(function () use ($invoice, $user) {
            $invoice->update([
                'status' => InvoiceStatus::PAID,
            ]);

            $this->timelineService->handle(
                invoice: $invoice,
                type: InvoiceTimelineType::PAYMENT_RECEIVED,
                user: $user,
                description: 'Invoice marked as paid.',
            );

            return $invoice->fresh();
        });
    }
}