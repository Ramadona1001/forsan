<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Horse;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Sponsor;
use App\Models\Stable;
use App\Models\Store;
use App\Services\FeaturedServicesService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->ordered()->get();

        $topBanners = Banner::active()->where('position', 'top')->orderBy('sort_order')->take(2)->get();
        $middleBanner = Banner::active()->where('position', 'middle')->first();

        $featuredHorses = Horse::active()
            ->featured()
            ->with(['owner:id,name', 'media'])
            ->take(100)
            ->latest()
            ->get();

        $featuredServices = FeaturedServicesService::getFeatured(10);


        $featuredProducts = Product::active()
            ->featured()
            ->inStock()
            ->with(['store:id,name', 'media'])
            ->take(100)
            ->latest()
            ->get();

        $stables = Stable::where('is_active', true)
            ->where('is_featured', true)
            ->with('media')
            ->take(100)
            ->latest()
            ->get();

        $latestBlogs = Blog::published()
            ->with(['author:id,name', 'media'])
            ->orderBy('published_at', 'desc')
            ->take(100)
            ->latest()
            ->get();

        $sponsors = Sponsor::active()->ordered()->get();

        return view('home', compact(
            'sliders',
            'topBanners',
            'middleBanner',
            'featuredHorses',
            'featuredServices',
            'featuredProducts',
            'stables',
            'latestBlogs',
            'sponsors'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->route('home');
        }

        $horses = Horse::active()
            ->where('name', 'like', "%{$query}%")
            ->orWhere('breed', 'like', "%{$query}%")
            ->with('media')
            ->take(10)
            ->get();

        $products = Product::active()
            ->where('name', 'like', "%{$query}%")
            ->with('media')
            ->take(10)
            ->get();

        $services = \App\Models\HorseReview::active()
            ->where('title', 'like', "%{$query}%")
            ->with('media')
            ->take(10)
            ->get();

        $stables = Stable::where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->with('media')
            ->take(10)
            ->get();

        return view('search', compact('query', 'horses', 'products', 'services', 'stables'));
    }

    public function about()
    {
        $about = \App\Models\AboutUs::content();
        $partners = Sponsor::active()->ordered()->get();
        $featuredServices = FeaturedServicesService::getFeatured(12);
        $knights = \App\Models\Knight::active()->ordered()->get();
        $overviewPage = \App\Models\InformationPage::where('slug', 'equestrian-sports-overview')->first();
        $equestrianSports = $overviewPage ? $overviewPage->equestrianSports()->active()->ordered()->with('media')->get() : collect();

        return view('pages.about', compact('about', 'partners', 'featuredServices', 'knights', 'equestrianSports'));
    }

    public function contact()
    {
        $settings = \App\Models\SiteSetting::getSettings();
        return view('pages.contact', compact('settings'));
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\ContactMessage::create($validated);

        return back()->with('success', 'تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
    }
}
