<?php

namespace App\Models;

use App\Enums\StockType;
use App\Traits\HasCreatedByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    use HasCreatedByTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sku',
        'price',
        'description',
        'category_id',
    ];

    protected $appends = [
        "stock_quantity",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal:2',
        'category_id' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class, 'product_id');
    }

    public function getStockQuantityAttribute(): int
    {
        // Sum the stock quantity based on the type of transaction
        return $this->stocks
            ->sum(function ($stock) {
                // Adjust stock quantity based on type
                return match ($stock->type) {
                    StockType::purchase,StockType::adjustment => $stock->quantity,
                    StockType::return => -$stock->quantity,
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
