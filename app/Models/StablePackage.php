<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class StablePackage extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'stable_id',
        'name',
        'description',
        'price',
        'features',
        'is_recommended',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'features' => 'array',
            'is_recommended' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function getTitleAttribute(): string
    {
        return $this->getTranslation('name', app()->getLocale())
            ?: (is_array($this->name) ? (array_values($this->name)[0] ?? '') : (string) $this->name);
    }

    public function stable(): BelongsTo
    {
        return $this->belongsTo(Stable::class);
    }
}
