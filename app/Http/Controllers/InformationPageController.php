<?php

namespace App\Http\Controllers;

use App\Models\EquestrianSport;
use App\Models\InformationPage;
use App\Models\Product;
use Illuminate\Http\Request;

class InformationPageController extends Controller
{
    public function show(string $slug)
    {
        $page = InformationPage::active()->bySlug($slug)->first();

        if (! $page) {
            abort(404);
        }

        $page->load('media');

        $products = collect();
        if ($page->template === InformationPage::TEMPLATE_WITH_PRODUCTS_SLIDER) {
            $products = Product::active()->inStock()->with('media')->take(12)->latest()->get();
        }

        $equestrianSports = collect();
        if ($slug === 'equestrian-sports-overview') {
            $equestrianSports = $page->equestrianSports()->active()->ordered()->with('media')->get();
        }

        return view('info.show', compact('page', 'products', 'equestrianSports'));
    }

    public function showSport(string $sport_slug)
    {
        $sport = EquestrianSport::active()->bySlug($sport_slug)->firstOrFail();
        $sport->load('media');

        $overviewPage = InformationPage::where('slug', 'equestrian-sports-overview')->first();
        $otherSports = $overviewPage
            ? $overviewPage->equestrianSports()->where('id', '!=', $sport->id)->active()->ordered()->with('media')->get()
            : collect();

        return view('info.sport-show', compact('sport', 'otherSports'));
    }
}
