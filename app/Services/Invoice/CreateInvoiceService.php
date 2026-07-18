<?php

namespace App\Services\Invoice;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceTimelineType;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\User;
use App\Services\Support\GenerateInvoiceNumberService;
use App\Services\Timeline\CreateInvoiceTimelineService;
use Illuminate\Support\Facades\DB;

class CreateInvoiceService
{
    public function __construct(
        protected GenerateInvoiceNumberService $generateInvoiceNumberService,
        protected CreateInvoiceTimelineService $timelineService,
    ) {
    }

    public function handle(
        Project $project,
        array $attributes,
        User $user,
    ): Invoice {
        return DB::transaction(function () use (
            $project,
            $attributes,
            $user
        ) {
            $invoice = Invoice::create([
                ...$attributes,
                'project_id' => $project->id,
                'invoice_number' => $this->generateInvoiceNumberService->handle(),
                'status' => InvoiceStatus::DRAFT,
            ]);

            $this->timelineService->handle(
                invoice: $invoice,
                type: InvoiceTimelineType::CREATED,
                user: $user,
                description: 'Invoice created.',
            );

            return $invoice;
        });
    }
}