<?php

namespace App\Services;

use App\Models\HorseReview;
use App\Models\Photography;
use Illuminate\Support\Collection;

class FeaturedServicesService
{
    /**
     * Returns a unified list of featured services (Horse Reviews, Photography, etc.)
     * for use in homepage, about page, and anywhere else. Add new service types here.
     */
    public static function getFeatured(int $limit = 10): Collection
    {
        $locale = app()->getLocale();
        $items = collect();

        // Horse Reviews
        $horseReviews = HorseReview::active()
            ->featured()
            ->with(['media'])
            ->latest()
            ->take($limit * 2)
            ->get();
        foreach ($horseReviews as $item) {
            $items->push([
                'id' => 'hr-' . $item->id,
                'title' => $item->getTranslation('title', $locale),
                'image' => $item->getFirstMediaUrl('image'),
                'url' => route('services.horse-reviews.show', $item->slug),
                'created_at' => $item->created_at,
            ]);
        }

        // Photography
        $photography = Photography::where('is_active', true)
            ->featured()
            ->with(['media'])
            ->latest()
            ->take($limit * 2)
            ->get();
        foreach ($photography as $item) {
            $items->push([
                'id' => 'ph-' . $item->id,
                'title' => $item->getTranslation('title', $locale),
                'image' => $item->getFirstMediaUrl('image'),
                'url' => route('services.photography.show', $item->slug),
                'created_at' => $item->created_at,
            ]);
        }

        // Add more service types here in the future, e.g.:
        // foreach (SomeOtherService::featured()->get() as $item) { ... }

        return $items->sortByDesc('created_at')->take($limit)->values();
    }
}
