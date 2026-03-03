<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Trainer extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['bio'];

    protected $fillable = [
        'user_id',
        'stable_id',
        'bio',
        'specializations',
        'license_number',
        'license_expiry',
        'experience_years',
        'hourly_rate',
        'rating',
        'reviews_count',
        'students_count',
        'availability',
        'is_verified',
        'is_active',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'specializations' => 'array',
            'license_expiry' => 'date',
            'hourly_rate' => 'decimal:2',
            'rating' => 'decimal:2',
            'availability' => 'array',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
        $this->addMediaCollection('certificates');
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stable(): BelongsTo
    {
        return $this->belongsTo(Stable::class);
    }

    public function services(): MorphMany
    {
        return $this->morphMany(Service::class, 'provider');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }
}
