<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $type = $request->get('type'); // product or service

        $query = Category::active()
            ->root()
            ->with('children')
            ->orderBy('order');

        if ($type) {
            $query->where('type', $type);
        }

        $categories = $query->get();

        return $this->success($categories);
    }

    public function show(Category $category): JsonResponse
    {
        $category->load('children', 'parent');

        return $this->success($category);
    }
}
