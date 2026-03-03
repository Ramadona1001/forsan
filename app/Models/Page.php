<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'content'];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'meta',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'is_published' => 'boolean',
        ];
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
