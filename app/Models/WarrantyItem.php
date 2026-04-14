<?php

namespace App\Models;

use App\Enums\WarrantyItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Warranty;

class WarrantyItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'warranty_id',
        'item_position',
        'product_name',
        'status',
        'expired_at',
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }

    public function warranty(): BelongsTo
    {
        return $this->belongsTo(Warranty::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return WarrantyItemStatus::label((string) $this->status);
    }
}