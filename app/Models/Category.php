<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'type',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    // Relationships
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfTypeProduct($query)
    {
        return $query->where('type', 'product');
    }

    public function scopeOfTypeService($query)
    {
        return $query->where('type', 'service');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}
