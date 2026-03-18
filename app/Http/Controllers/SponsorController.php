<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::active()->ordered()->with('media')->paginate(18);
        return view('sponsors.index', compact('sponsors'));
    }
}
