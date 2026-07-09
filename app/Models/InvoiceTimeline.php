<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceTimeline extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'type',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'type' => InvoiceTimelineType::class,
            'created_at' => 'datetime',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}