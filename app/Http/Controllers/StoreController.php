<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Store::where('is_active', true)
            ->with(['owner:id,name', 'media'])
            ->withCount('products');

        // Filters
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popular':
                $query->orderBy('products_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $stores = $query->paginate(12)->withQueryString();

        $cities = Store::where('is_active', true)->distinct()->pluck('city')->filter();

        return view('stores.index', compact('stores', 'cities'));
    }

    public function show(Store $store)
    {
        $store->load(['owner:id,name,phone', 'media']);
        $store->loadCount('products');

        $products = $store->products()
            ->active()
            ->inStock()
            ->with('media')
            ->paginate(12);

        return view('stores.show', compact('store', 'products'));
    }
}
