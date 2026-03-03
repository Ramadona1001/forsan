<?php

namespace App\Http\Controllers\Api;

use App\Models\Stable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class StableController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $stables = QueryBuilder::for(Stable::class)
            ->allowedFilters(['city', 'country'])
            ->allowedSorts(['rating', 'created_at', 'name'])
            ->where('is_active', true)
            ->with(['owner:id,name', 'media'])
            ->withCount('horses')
            ->paginate($request->per_page ?? 15);

        return $this->paginated($stables);
    }

    public function show(Stable $stable): JsonResponse
    {
        $stable->load(['owner:id,name,phone', 'horses', 'trainers.user:id,name', 'media']);
        $stable->loadCount(['horses', 'trainers']);

        return $this->success($stable);
    }

    public function services(Stable $stable): JsonResponse
    {
        $services = $stable->services()->active()->with('category:id,name')->get();

        return $this->success($services);
    }
}
