<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class PhotographyPackage extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name', 'description', 'features'];

    protected $fillable = [
        'photography_id',
        'name',
        'price',
        'description',
        'features',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
    ];

    public function photography()
    {
        return $this->belongsTo(Photography::class);
    }
}
