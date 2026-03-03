<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->published()->firstOrFail();

        return view('pages.show', compact('page'));
    }

    public function blogs(Request $request)
    {
        $blogs = Blog::published()
            ->with(['author:id,name', 'category:id,name', 'media'])
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('blogs.index', compact('blogs'));
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)->published()->firstOrFail();
        $blog->incrementViews();
        $blog->load(['author:id,name', 'category:id,name', 'media']);

        // Related blogs
        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->with('media')
            ->latest('published_at')
            ->take(6) // increased to 6 for carousel
            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}
