<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'description',
        'sku',
        'price',
        'compare_price',
        'cost',
        'stock',
        'low_stock_threshold',
        'weight',
        'dimensions',
        'attributes',
        'is_active',
        'is_featured',
        'track_inventory',
        'views_count',
        'sales_count',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'cost' => 'decimal:2',
            'dimensions' => 'array',
            'attributes' => 'array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'track_inventory' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    // Relationships
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Helpers
    public function isOnSale(): bool
    {
        return $this->compare_price && $this->compare_price > $this->price;
    }

    public function getDiscountPercentage(): ?float
    {
        if (!$this->isOnSale()) {
            return null;
        }

        return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    public function isInStock(): bool
    {
        if (!$this->track_inventory) {
            return true;
        }

        return $this->stock > 0;
    }

    public function isLowStock(): bool
    {
        return $this->track_inventory && $this->stock <= $this->low_stock_threshold;
    }

    public function isOutOfStock(): bool
    {
        return $this->track_inventory && $this->stock <= 0;
    }
}
