<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Horse;
use Illuminate\Http\Request;

class HorseController extends Controller
{
    public function index(Request $request)
    {
        $query = Horse::active()->with(['owner:id,name', 'stable:id,name', 'media']);

        // Filters
        if ($request->filled('filter')) {
            if ($request->filter === 'for_sale') {
                $query->forSale();
            } elseif ($request->filter === 'for_rent') {
                $query->forRent();
            }
        }

        if ($request->filled('breed')) {
            $query->where('breed', $request->breed);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $horses = $query->paginate(12)->withQueryString();

        // Get unique breeds for filter
        $breeds = Horse::active()->distinct()->pluck('breed')->filter();

        return view('horses.index', compact('horses', 'breeds'));
    }

    public function show(Horse $horse)
    {
        $horse->incrementViews();
        $horse->load(['owner:id,name,phone', 'stable', 'media']);

        // Related horses
        $relatedHorses = Horse::active()
            ->where('id', '!=', $horse->id)
            ->where(function ($q) use ($horse) {
                $q->where('breed', $horse->breed)
                    ->orWhere('stable_id', $horse->stable_id);
            })
            ->with('media')
            ->take(4)
            ->get();

        return view('horses.show', compact('horse', 'relatedHorses'));
    }
}
