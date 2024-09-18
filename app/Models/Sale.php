<?php

namespace App\Models;

use App\Traits\HasCreatedByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Sale extends Model
{
    use HasFactory;
    use HasCreatedByTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_amount',
        'payment_method',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactable');
    }
}
