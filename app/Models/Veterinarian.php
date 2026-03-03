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

class Veterinarian extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['bio'];

    protected $fillable = [
        'user_id',
        'bio',
        'license_number',
        'license_expiry',
        'specializations',
        'clinic_name',
        'clinic_address',
        'clinic_phone',
        'experience_years',
        'consultation_fee',
        'rating',
        'reviews_count',
        'availability',
        'home_visits',
        'emergency_available',
        'is_verified',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'license_expiry' => 'date',
            'specializations' => 'array',
            'consultation_fee' => 'decimal:2',
            'rating' => 'decimal:2',
            'availability' => 'array',
            'home_visits' => 'boolean',
            'emergency_available' => 'boolean',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
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

    public function scopeEmergencyAvailable($query)
    {
        return $query->where('emergency_available', true);
    }
}
