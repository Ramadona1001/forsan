<?php

namespace App\Http\Controllers;

use App\Models\Photography;
use Illuminate\Http\Request;

class PhotographyController extends Controller
{
    public function show($slug)
    {
        $photography = Photography::where('slug', $slug)
            ->where('is_active', true)
            ->with(['packages'])
            ->firstOrFail();

        return view('services.photography.show', compact('photography'));
    }
}
