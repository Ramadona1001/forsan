<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
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

        $bookings = Booking::with(['user', 'horse', 'bookable'])->latest()->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->ensureAdmin();

        $booking->load(['user', 'horse', 'bookable']);

        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_column(BookingStatus::cases(), 'value'))],
        ]);

        $booking->status = $data['status'];
        $booking->save();

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', __('Booking updated successfully.'));
    }
}

