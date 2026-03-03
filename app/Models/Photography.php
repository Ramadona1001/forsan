<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Photography extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    protected $table = 'service_photographies';

    public array $translatable = ['title', 'description', 'features'];

    protected $fillable = [
        'title',
        'slug',
        'price',
        'description',
        'features',
        'video_gallery',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'video_gallery' => 'array',
        'features' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function packages()
    {
        return $this->hasMany(PhotographyPackage::class);
    }
}

