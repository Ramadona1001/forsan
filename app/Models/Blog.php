<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Blog extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['title', 'excerpt', 'content'];

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'tags',
        'is_published',
        'is_featured',
        'published_at',
        'views_count',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    // Relationships
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
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
