<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function ensureAdmin(): void
    {
        if (! Auth::user()?->isAdmin()) {
            abort(403);
        }
    }

    public function index()
    {
        $this->ensureAdmin();

        $categories = Category::ofTypeService()->with('parent')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->ensureAdmin();

        $parents = Category::ofTypeService()->root()->pluck('name', 'id');

        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['type'] = 'service';
        $data['is_active'] = $request->boolean('is_active');

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', __('Category created successfully.'));
    }

    public function edit(Category $category)
    {
        $this->ensureAdmin();

        $parents = Category::ofTypeService()->root()->where('id', '!=', $category->id)->pluck('name', 'id');

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', __('Category updated successfully.'));
    }

    public function destroy(Category $category)
    {
        $this->ensureAdmin();

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', __('Category deleted successfully.'));
    }
}

