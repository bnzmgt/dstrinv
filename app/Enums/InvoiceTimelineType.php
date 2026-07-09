<?php

namespace App\Enums;

enum InvoiceTimelineType: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
    case SENT = 'sent';
    case PAYMENT_RECEIVED = 'payment_received';
    case STATUS_CHANGED = 'status_changed';
    case NOTE = 'note';

    public function label(): string
    {
        return match ($this) {
            self::CREATED => 'Created',
            self::UPDATED => 'Updated',
            self::SENT => 'Sent',
            self::PAYMENT_RECEIVED => 'Payment Received',
            self::STATUS_CHANGED => 'Status Changed',
            self::NOTE => 'Note',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $type) => [
                $type->value => $type->label(),
            ])
            ->all();
    }
}