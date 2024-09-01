<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_type',
        'user_id',
        'transactable_id',
        'transactable_type',
        'amount',
        'details',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'transactable_id' => 'integer',
        'amount' => 'decimal:2',
        'details' => 'array',
    ];

    public function transactable(): MorphTo
    {
        return $this->morphTo();
    }
}
