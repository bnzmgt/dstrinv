<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\InvoiceStatus;

class Invoice extends Model
{
    protected $fillable = [
        'project_id',
        'invoice_number',
        'title',
        'issue_date',
        'due_date',
        'status',
        'notes',
        'sent_at',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => InvoiceStatus::class,
            'issue_date' => 'date',
            'due_date' => 'date',
            'sent_at' => 'datetime',
            'paid_at' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(InvoiceTimeline::class);
    }

    // scope
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', InvoiceStatus::DRAFT);
    }

    public function scopeSent(Builder $query): Builder
    {
        return $query->where('status', InvoiceStatus::SENT);
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->where('status', InvoiceStatus::PAID);
    }

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->sum(
                fn (InvoiceItem $item) => $item->qty * $item->unit_price
            ),
        );
    }

    protected function paymentTotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->payments->sum('amount'),
        );
    }

    protected function outstandingAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => max(
                0,
                $this->subtotal - $this->payment_total
            ),
        );
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->subtotal,
        );
    }

    protected function totalItems(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->count(),
        );
    }

    protected function totalQuantity(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->sum('qty'),
        );
    }

    protected function client(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->project->client,
        );
    }

    protected function downloadFilename(): Attribute
    {
        return Attribute::make(
            get: fn (): string => sprintf(
                'INV-%04d-%s.pdf',
                $this->id,
                now()->format('Ymd')
            ),
        );
    }
}