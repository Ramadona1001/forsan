<?php

namespace App\Models;

use App\Enums\HorseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Horse extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'owner_id',
        'stable_id',
        'name',
        'description',
        'breed',
        'color',
        'gender',
        'birth_date',
        'age',
        'height',
        'weight',
        'registration_number',
        'passport_number',
        'microchip_number',
        'price',
        'rent_price_per_day',
        'status',
        'disciplines',
        'health_records',
        'achievements',
        'father_name',
        'mother_name',
        'pedigree',
        'is_for_sale',
        'is_for_rent',
        'is_featured',
        'is_active',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'height' => 'decimal:2',
            'weight' => 'decimal:2',
            'price' => 'decimal:2',
            'rent_price_per_day' => 'decimal:2',
            'status' => HorseStatus::class,
            'disciplines' => 'array',
            'health_records' => 'array',
            'achievements' => 'array',
            'is_for_sale' => 'boolean',
            'is_for_rent' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->singleFile();
        $this->addMediaCollection('gallery');
        $this->addMediaCollection('documents');
        $this->addMediaCollection('videos');
    }

    // Relationships
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function stable(): BelongsTo
    {
        return $this->belongsTo(Stable::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // Scopes
    public function scopeForSale($query)
    {
        return $query->where('is_for_sale', true)->where('status', HorseStatus::AVAILABLE);
    }

    public function scopeForRent($query)
    {
        return $query->where('is_for_rent', true)->where('status', HorseStatus::FOR_RENT);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Helpers
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
