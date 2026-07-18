<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Services\Invoice\UpdateInvoiceService;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function handleRecordUpdate(
        Model $record,
        array $data,
    ): Model {
        return resolve(UpdateInvoiceService::class)->handle(
            invoice: $record,
            attributes: $data,
        );
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('view', [
            'record' => $this->getRecord(),
        ]);
    }
}