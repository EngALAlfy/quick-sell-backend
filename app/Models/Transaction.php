<?php

namespace App\Models;

use App\Traits\HasCreatedByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;
    use HasCreatedByTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'transactable_id',
        'transactable_type',
        'amount',
        'product_id',
        'quantity',
        'details',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'details' => 'array',
    ];

    public function transactable(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
