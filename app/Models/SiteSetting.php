<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'contact_banner_heading',
        'contact_address',
        'contact_phone',
        'contact_whatsapp',
        'contact_email',
        'working_hours',
        'logo',
        'favicon',
    ];

    protected function casts(): array
    {
        return [
            'contact_banner_heading' => 'array',
            'contact_address' => 'array',
            'working_hours' => 'array',
        ];
    }

    public static function getSettings(): ?self
    {
        return static::first();
    }

    public function getContactBannerHeading(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $val = $this->contact_banner_heading ?? [];
        return is_array($val) ? ($val[$locale] ?? $val['ar'] ?? '') : (string) $val;
    }

    public function getContactAddressLines(?string $locale = null): array
    {
        $locale = $locale ?? app()->getLocale();
        $val = $this->contact_address ?? [];
        $text = is_array($val) ? ($val[$locale] ?? $val['ar'] ?? '') : (string) $val;
        return $text ? array_filter(explode("\n", $text)) : [];
    }

    public function getWorkingHoursText(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $val = $this->working_hours ?? [];
        $text = is_array($val) ? ($val[$locale] ?? $val['ar'] ?? '') : (string) $val;
        return $text ?: '';
    }

    public function getLogoUrl(): ?string
    {
        if (! $this->logo) {
            return null;
        }
        return str_starts_with($this->logo, 'http') ? $this->logo : asset('storage/' . $this->logo);
    }

    public function getFaviconUrl(): ?string
    {
        if (! $this->favicon) {
            return null;
        }
        return str_starts_with($this->favicon, 'http') ? $this->favicon : asset('storage/' . $this->favicon);
    }
}
