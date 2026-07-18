<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Mail\InvoiceMail;
use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource;
use App\Services\Invoice\DeleteInvoiceService;
use App\Services\Invoice\MarkInvoicePaidService;
use App\Services\Invoice\SendInvoiceService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
{
    return [

        Actions\EditAction::make(),

        Actions\ActionGroup::make([

            Actions\Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->url(fn () => route('invoices.preview', $this->record))
                ->openUrlInNewTab(),

            Actions\Action::make('print')
                ->label('Print')
                ->icon('heroicon-o-printer')
                ->url(fn () => route('invoices.print', $this->record))
                ->openUrlInNewTab(),

            Actions\Action::make('pdf')
                ->label('View PDF')
                ->icon('heroicon-o-document')
                ->url(fn () => route('invoices.pdf', $this->record))
                ->openUrlInNewTab(),

            Actions\Action::make('download')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn () => route('invoices.download', $this->record))
                ->openUrlInNewTab(),

        ])
            ->label('Preview')
            ->icon('heroicon-o-document-text'),

        Actions\ActionGroup::make([

            Actions\Action::make('email')
                ->label('Email')
                ->icon('heroicon-o-envelope')
                ->requiresConfirmation()
                ->action(function () {

                    Mail::to($this->record->project->client->email)
                        ->send(new InvoiceMail($this->record));

                    Notification::make()
                        ->success()
                        ->title('Invoice email sent successfully.')
                        ->send();

                }),

            Actions\Action::make('whatsapp')
                ->label('WhatsApp')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->url(fn () => route('invoices.whatsapp', $this->record))
                ->openUrlInNewTab(),

            Actions\Action::make('share')
                ->label('Share Link')
                ->icon('heroicon-o-link')
                ->url(fn () => URL::temporarySignedRoute(
                    'invoices.share',
                    now()->addDays(7),
                    [
                        'invoice' => $this->record,
                    ]
                ))
                ->openUrlInNewTab(),

        ])
            ->label('Share')
            ->icon('heroicon-o-paper-airplane'),

        Actions\ActionGroup::make([

            Actions\Action::make('send')
                ->label('Send Invoice')
                ->icon('heroicon-o-paper-airplane')
                ->visible(fn () => $this->record->status === InvoiceStatus::DRAFT)
                ->requiresConfirmation()
                ->action(function () {

                    resolve(SendInvoiceService::class)->handle(
                        invoice: $this->record,
                        user: auth()->user(),
                    );

                    $this->record->refresh();

                    Notification::make()
                        ->success()
                        ->title('Invoice sent successfully.')
                        ->send();

                }),

            Actions\Action::make('paid')
                ->label('Mark as Paid')
                ->icon('heroicon-o-check-circle')
                ->visible(fn () => $this->record->status === InvoiceStatus::SENT)
                ->requiresConfirmation()
                ->action(function () {

                    resolve(MarkInvoicePaidService::class)->handle(
                        invoice: $this->record,
                        user: auth()->user(),
                    );

                    $this->record->refresh();

                    Notification::make()
                        ->success()
                        ->title('Invoice marked as paid.')
                        ->send();

                }),

        ])
            ->label('Workflow')
            ->icon('heroicon-o-arrow-path'),

        Actions\DeleteAction::make()
            ->action(function () {

                resolve(DeleteInvoiceService::class)->handle(
                    $this->record,
                );

                redirect(InvoiceResource::getUrl());

            }),

    ];
}
}