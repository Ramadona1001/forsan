<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'about_us';

    public array $translatable = [
        'about_title',
        'about_content',
        'vision_title',
        'vision_content',
        'goals_title',
        'goals_content',
        'quote_text',
        'services_heading',
        'services_subtext',
        'partners_heading',
        'knights_heading',
        'sports_heading',
        'sports_subtext',
    ];

    protected $fillable = [
        'about_image',
        'about_title',
        'about_content',
        'vision_title',
        'vision_content',
        'goals_title',
        'goals_content',
        'quote_text',
        'services_heading',
        'services_subtext',
        'partners_heading',
        'knights_heading',
        'sports_heading',
        'sports_subtext',
    ];

    public static function content(): ?self
    {
        return static::first();
    }
}
