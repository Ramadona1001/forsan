<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    protected $fillable = ['title', 'link', 'position', 'sort_order', 'is_active'];

    public $translatable = ['title'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
