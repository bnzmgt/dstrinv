<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Project;
use App\Services\Invoice\CreateInvoiceService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $project = Project::findOrFail($data['project_id']);

        unset($data['project_id']);

        return resolve(CreateInvoiceService::class)->handle(
            project: $project,
            attributes: $data,
            user: auth()->user(),
        );
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('view', [
            'record' => $this->record,
        ]);
    }
}