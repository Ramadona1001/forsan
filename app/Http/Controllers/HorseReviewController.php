<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HorseReviewController extends Controller
{
    public function index()
    {
        $services = \App\Models\HorseReview::active()->paginate(9);
        $pageTitle = __('services.Horse Reviews');
        $pageDescription = __('services.Enjoy the magic of horse reviews...'); // Ensure these keys exist or use hardcoded/translatable strings

        return view('services.horse-reviews.index', compact('services', 'pageTitle', 'pageDescription'));
    }

    public function show($slug)
    {
        $horseReview = \App\Models\HorseReview::where('slug', $slug)->first();

        // Fetch related services (for now, simply other active horse reviews)
        $relatedHorses = \App\Models\HorseReview::where('slug', '!=', $slug)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('services.horse-reviews.show', compact('horseReview', 'relatedHorses'));
    }
}
