<?php

namespace App\Http\Controllers;

use App\Models\Stable;
use App\Models\StablePackage;
use Illuminate\Http\Request;

class StableController extends Controller
{
    public function index(Request $request)
    {
        $query = Stable::where('is_active', true)
            ->with(['owner:id,name', 'media'])
            ->withCount(['horses', 'trainers']);

        // Filters
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popular':
                $query->orderBy('horses_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $stables = $query->paginate(12)->withQueryString();

        // Get unique cities for filter
        $cities = Stable::where('is_active', true)->distinct()->pluck('city')->filter();

        return view('stables.index', compact('stables', 'cities'));
    }

    public function show(Stable $stable)
    {
        $stable->load(['owner:id,name,phone', 'horses.media', 'trainers.user:id,name', 'media']);
        $stable->loadCount(['horses', 'trainers']);

        $services = collect();
        $packages = $stable->packages()->where('is_active', true)->orderBy('sort_order')->get();

        return view('stables.show', compact('stable', 'services', 'packages'));
    }

    public function packageShow(Stable $stable, StablePackage $package)
    {
        abort_unless($package->stable_id === $stable->id, 404);
        abort_unless($package->is_active, 404);

        $stable->loadCount(['horses', 'trainers']);

        return view('stables.package-details', compact('stable', 'package'));
    }
}
