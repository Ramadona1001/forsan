<?php

namespace App\Http\Controllers\Api;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $bookings = $request->user()
            ->bookings()
            ->with(['service:id,name,price', 'horse:id,name'])
            ->orderBy('date', 'desc')
            ->paginate($request->per_page ?? 15);

        return $this->paginated($bookings);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'horse_id' => ['nullable', 'exists:horses,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'service_id' => $validated['service_id'],
            'horse_id' => $validated['horse_id'] ?? null,
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'duration' => $service->duration,
            'price' => $service->price,
            'status' => $service->requires_approval ? BookingStatus::PENDING : BookingStatus::CONFIRMED,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Increment service bookings count
        $service->increment('bookings_count');

        return $this->success($booking->load(['service', 'horse']), 'تم الحجز بنجاح', 201);
    }

    public function show(Request $request, Booking $booking): JsonResponse
    {
        if ($booking->user_id !== $request->user()->id) {
            return $this->error('غير مصرح', 403);
        }

        $booking->load(['service.provider', 'horse', 'user:id,name,phone']);

        return $this->success($booking);
    }

    public function cancel(Request $request, Booking $booking): JsonResponse
    {
        if ($booking->user_id !== $request->user()->id) {
            return $this->error('غير مصرح', 403);
        }

        if (!$booking->canBeCancelled()) {
            return $this->error('لا يمكن إلغاء هذا الحجز', 400);
        }

        $reason = $request->input('reason');
        $booking->cancel($reason);

        return $this->success($booking, 'تم إلغاء الحجز بنجاح');
    }
}
