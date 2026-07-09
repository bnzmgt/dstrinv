<?php

namespace App\Services\Timeline;

use App\Enums\InvoiceTimelineType;
use App\Models\Invoice;
use App\Models\InvoiceTimeline;
use App\Models\User;

class CreateInvoiceTimelineService
{
    public function handle(
        Invoice $invoice,
        InvoiceTimelineType $type,
        User $user,
        ?string $description = null,
    ): InvoiceTimeline {
        return InvoiceTimeline::create([
            'invoice_id' => $invoice->id,
            'user_id' => $user->id,
            'type' => $type,
            'description' => $description,
        ]);
    }
}