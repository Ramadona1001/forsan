<?php

namespace App\Http\Controllers;

use App\Models\Knight;

class KnightController extends Controller
{
    public function show(string $slug)
    {
        $knight = Knight::where('slug', $slug)->active()->firstOrFail();
        return view('knights.show', compact('knight'));
    }
}
