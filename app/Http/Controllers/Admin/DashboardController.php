<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (! Auth::user()?->isAdmin()) {
            abort(403);
        }

        $stats = [
            'users_count' => User::count(),
            'services_count' => Service::count(),
            'categories_count' => Category::ofTypeService()->count(),
            'bookings_count' => Booking::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

