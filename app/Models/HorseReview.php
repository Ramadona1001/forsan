<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class HorseReview extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    protected $table = 'service_horse_reviews';

    public array $translatable = ['title', 'description', 'trainer_info'];


    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'trainer_info',
        'video_gallery',
        'is_active',
        'is_featured',
    ];


    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'video_gallery' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
        $this->addMediaCollection('gallery');
        $this->addMediaCollection('trainer_image')->singleFile();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
