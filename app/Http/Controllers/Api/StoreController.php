<?php

namespace App\Http\Controllers\Api;

use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class StoreController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $stores = QueryBuilder::for(Store::class)
            ->allowedFilters(['city', 'country'])
            ->allowedSorts(['rating', 'created_at', 'name'])
            ->where('is_active', true)
            ->with(['owner:id,name', 'media'])
            ->withCount('products')
            ->paginate($request->per_page ?? 15);

        return $this->paginated($stores);
    }

    public function show(Store $store): JsonResponse
    {
        $store->load(['owner:id,name,phone', 'media']);
        $store->loadCount('products');

        return $this->success($store);
    }

    public function products(Store $store, Request $request): JsonResponse
    {
        $products = $store->products()
            ->active()
            ->inStock()
            ->with(['category:id,name', 'media'])
            ->paginate($request->per_page ?? 15);

        return $this->paginated($products);
    }
}
