<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class InformationPage extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public const TEMPLATE_DEFAULT = 'default';
    public const TEMPLATE_WITH_TABLE = 'with_table';
    public const TEMPLATE_WITH_PRODUCTS_SLIDER = 'with_products_slider';
    public const TEMPLATE_WITH_SPORTS_SLIDER = 'with_sports_slider';

    public array $translatable = ['title', 'content', 'extra_section_title', 'extra_section_content'];

    protected $fillable = [
        'slug',
        'title',
        'content',
        'extra_section_title',
        'extra_section_content',
        'table_data',
        'template',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'table_data' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slider_images');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeBySlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    public function equestrianSports()
    {
        return $this->hasMany(EquestrianSport::class)->orderBy('sort_order');
    }
}
