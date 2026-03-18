<?php

namespace App\Http\Controllers;

use App\Models\Knight;

class KnightController extends Controller
{
    public function index()
    {
        $knights = Knight::active()->ordered()->with('media')->paginate(12);
        return view('knights.index', compact('knights'));
    }

    public function show(string $slug)
    {
        $knight = Knight::where('slug', $slug)->active()->firstOrFail();
        return view('knights.show', compact('knight'));
    }
}
