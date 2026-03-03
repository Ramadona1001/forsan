<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Sponsor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContentController extends BaseController
{
    public function sliders(): JsonResponse
    {
        $sliders = Slider::active()
            ->ordered()
            ->get();

        return $this->success($sliders);
    }

    public function blogs(Request $request): JsonResponse
    {
        $blogs = Blog::published()
            ->with(['author:id,name', 'category:id,name', 'media'])
            ->orderBy('published_at', 'desc')
            ->paginate($request->per_page ?? 10);

        return $this->paginated($blogs);
    }

    public function blog(Blog $blog): JsonResponse
    {
        if (!$blog->is_published) {
            return $this->error('المقال غير موجود', 404);
        }

        $blog->incrementViews();
        $blog->load(['author:id,name', 'category:id,name', 'media']);

        return $this->success($blog);
    }

    public function page(Page $page): JsonResponse
    {
        if (!$page->is_published) {
            return $this->error('الصفحة غير موجودة', 404);
        }

        return $this->success($page);
    }

    public function sponsors(): JsonResponse
    {
        $sponsors = Sponsor::active()
            ->ordered()
            ->get();

        return $this->success($sponsors);
    }
}
