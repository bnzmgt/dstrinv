<?php

namespace App\Services\Invoice;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceTimelineType;
use App\Models\Invoice;
use App\Models\User;
use App\Services\Timeline\CreateInvoiceTimelineService;
use DomainException;
use Illuminate\Support\Facades\DB;

class SendInvoiceService
{
    public function __construct(
        protected CreateInvoiceTimelineService $timelineService,
    ) {
    }

    public function handle(
        Invoice $invoice,
        User $user,
    ): Invoice {
        if ($invoice->status !== InvoiceStatus::Draft) {
            throw new DomainException(
                'Only draft invoices can be sent.'
            );
        }

        return DB::transaction(function () use (
            $invoice,
            $user
        ) {
            $invoice->update([
                'status' => InvoiceStatus::Sent,
            ]);

            $this->timelineService->handle(
                invoice: $invoice,
                type: InvoiceTimelineType::SENT,
                user: $user,
                description: 'Invoice sent.',
            );

            return $invoice->fresh();
        });
    }
}