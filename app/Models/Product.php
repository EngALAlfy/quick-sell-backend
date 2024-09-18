<?php

namespace App\Models;

use App\Enums\TransactionType;
use App\Traits\HasCreatedByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use HasCreatedByTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sku',
        'sell_price',
        'purchase_price',
        'stock_quantity',
        'description',
        'category_id',
        'enable_stock',
        'alert_quantity',
        'status',
    ];

    protected $appends = [
        "current_stock",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'enable_stock' => 'boolean',
    ];

    protected static function booted()
    {
        parent::booted();
        self::created(function (Product $product) {
            if ($product->enable_stock) {
                $product->transactions()->create([
                    "type" => TransactionType::open_stock->value,
                    "quantity" => $product->stock_quantity,
                    "amount" => 0,
                ]);
            }
        });
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'product_id');
    }

    public function getCurrentStockAttribute(): int
    {
        // Sum the stock quantity based on the type of transaction
        return $this->transactions
            ->sum(function ($transaction) {
                // Adjust stock quantity based on type
                return match ($transaction->type) {
                    TransactionType::open_stock->value, TransactionType::purchase->value, TransactionType::adjustment->value, TransactionType::sell_return->value => $transaction->quantity,
                    TransactionType::purchase_return->value, TransactionType::sell->value, => -$transaction->quantity,
                    default => 0,
                };
            });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useFallbackUrl(asset("assets/admin/img/placeholder.jpg"));
    }
}
