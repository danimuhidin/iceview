<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\WarrantyItem;

class Warranty extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'customer_name',
        'customer_email',
        'car_type',
        'engine_number',
        'license_plate_number',
        'warranty_code',
    ];

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dealer_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(WarrantyItem::class);
    }
}