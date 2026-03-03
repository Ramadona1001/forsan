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

class Store extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'phone',
        'email',
        'website',
        'address',
        'city',
        'country',
        'latitude',
        'longitude',
        'working_hours',
        'rating',
        'reviews_count',
        'is_verified',
        'is_active',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'working_hours' => 'array',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'rating' => 'decimal:2',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

    // Relationships
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
