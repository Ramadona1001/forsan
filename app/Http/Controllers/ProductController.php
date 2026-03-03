<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()
            ->inStock()
            ->with(['store:id,name', 'category:id,name', 'media']);

        // Filters
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->filled('store')) {
            $query->where('store_id', $request->store);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('sales_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::ofTypeProduct()->active()->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->increment('views_count');
        $product->load(['store', 'category', 'media']);

        // Related products
        $relatedProducts = Product::active()
            ->inStock()
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category_id', $product->category_id)
                    ->orWhere('store_id', $product->store_id);
            })
            ->with('media')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
