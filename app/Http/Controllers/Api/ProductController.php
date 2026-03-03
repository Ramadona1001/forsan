<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProductController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('store_id'),
                AllowedFilter::exact('category_id'),
                AllowedFilter::exact('is_featured'),
                'name',
            ])
            ->allowedSorts(['price', 'created_at', 'sales_count', 'name'])
            ->active()
            ->inStock()
            ->with(['store:id,name', 'category:id,name', 'media'])
            ->paginate($request->per_page ?? 15);

        return $this->paginated($products);
    }

    public function show(Product $product): JsonResponse
    {
        $product->increment('views_count');

        $product->load(['store:id,name,phone,address', 'category:id,name', 'media']);

        return $this->success($product);
    }
}
