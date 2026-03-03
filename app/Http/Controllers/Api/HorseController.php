<?php

namespace App\Http\Controllers\Api;

use App\Models\Horse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class HorseController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $horses = QueryBuilder::for(Horse::class)
            ->allowedFilters([
                'breed',
                'color',
                'gender',
                AllowedFilter::exact('is_for_sale'),
                AllowedFilter::exact('is_for_rent'),
                AllowedFilter::exact('status'),
                AllowedFilter::exact('stable_id'),
                AllowedFilter::scope('price_min', 'where', 'price', '>='),
                AllowedFilter::scope('price_max', 'where', 'price', '<='),
            ])
            ->allowedSorts(['price', 'created_at', 'views_count', 'name'])
            ->active()
            ->with(['owner:id,name', 'stable:id,name', 'media'])
            ->paginate($request->per_page ?? 15);

        return $this->paginated($horses);
    }

    public function show(Horse $horse): JsonResponse
    {
        $horse->incrementViews();

        $horse->load(['owner:id,name,phone', 'stable:id,name,address', 'media']);

        return $this->success($horse);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'breed' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:50'],
            'gender' => ['nullable', 'in:male,female'],
            'birth_date' => ['nullable', 'date'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'rent_price_per_day' => ['nullable', 'numeric', 'min:0'],
            'is_for_sale' => ['boolean'],
            'is_for_rent' => ['boolean'],
            'stable_id' => ['nullable', 'exists:stables,id'],
        ]);

        $validated['owner_id'] = $request->user()->id;

        $horse = Horse::create($validated);

        return $this->success($horse, 'تم إضافة الحصان بنجاح', 201);
    }

    public function update(Request $request, Horse $horse): JsonResponse
    {
        if ($horse->owner_id !== $request->user()->id) {
            return $this->error('غير مصرح', 403);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'breed' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:50'],
            'gender' => ['nullable', 'in:male,female'],
            'birth_date' => ['nullable', 'date'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'rent_price_per_day' => ['nullable', 'numeric', 'min:0'],
            'is_for_sale' => ['boolean'],
            'is_for_rent' => ['boolean'],
            'stable_id' => ['nullable', 'exists:stables,id'],
        ]);

        $horse->update($validated);

        return $this->success($horse, 'تم تحديث بيانات الحصان بنجاح');
    }

    public function destroy(Request $request, Horse $horse): JsonResponse
    {
        if ($horse->owner_id !== $request->user()->id) {
            return $this->error('غير مصرح', 403);
        }

        $horse->delete();

        return $this->success(null, 'تم حذف الحصان بنجاح');
    }
}
