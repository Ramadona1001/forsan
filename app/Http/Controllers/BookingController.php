<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Stable;
use App\Models\StablePackage;
// use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// class BookingController extends Controller
// {
//     public function create($service) // Removed type hint Service
//     {
//         // Service deleted.
//         abort(404, 'Service module deleted.');
//     }

//     public function store(Request $request, $service) // Removed type hint Service
//     {
//         // Service deleted.
//         abort(404, 'Service module deleted.');
class BookingController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'package_type' => 'nullable|string',
            'package_id' => 'nullable|integer',
            'date' => 'required|date|after_or_equal:today',
            'horse_id' => 'nullable|exists:horses,id',
            'notes' => 'nullable|string|max:1000',
        ];

        if ($request->input('bookable_type') === 'stable') {
            $rules['start_time'] = 'required|date_format:H:i';
            $rules['duration_hours'] = 'required|integer|min:1|max:24';
        }

        $validated = $request->validate($rules);

        $typeMap = [
            'horse_review' => \App\Models\HorseReview::class,
            'photography' => \App\Models\Photography::class,
            'stable' => \App\Models\Stable::class,
        ];

        $packageTypeMap = [
            'photography_package' => \App\Models\PhotographyPackage::class,
            'stable_package' => \App\Models\StablePackage::class,
        ];

        $modelClass = $typeMap[$validated['bookable_type']] ?? null;

        if (!$modelClass) {
            return redirect()->back()->withErrors(['bookable_type' => 'نوع الحجز غير صالح.'])->withInput();
        }

        /** @var \Illuminate\Database\Eloquent\Model $bookable */
        $bookable = $modelClass::findOrFail($validated['bookable_id']);

        $package = null;
        $price = 0;
        $startTime = '00:00';
        $durationMinutes = 60;

        if ($validated['bookable_type'] === 'stable') {
            $startTime = $validated['start_time'];
            $durationMinutes = (int) ($validated['duration_hours'] ?? 1) * 60;

            if (!empty($validated['package_type']) && !empty($validated['package_id'])) {
                $packageModelClass = $packageTypeMap[$validated['package_type']] ?? null;
                if ($packageModelClass) {
                    $package = $packageModelClass::findOrFail($validated['package_id']);

                    // تأكد إن الباقة تخص نفس الإسطبل
                    if ($package instanceof StablePackage && $bookable instanceof Stable && $package->stable_id !== $bookable->getKey()) {
                        return redirect()->back()->withErrors(['package_id' => 'هذه الباقة لا تخص هذا الإسطبل.'])->withInput();
                    }

                    $price = $package->price ?? 0;
                }
            }
        } else {
            $service = $bookable;
            $price = $service->price ?? 0;
            $startTime = $request->input('start_time', '00:00');
            if (!empty($validated['package_type']) && !empty($validated['package_id'])) {
                $packageModelClass = $packageTypeMap[$validated['package_type']] ?? null;
                if ($packageModelClass) {
                    $package = $packageModelClass::findOrFail($validated['package_id']);
                    $price = $package->price ?? $price;
                }
            }
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'bookable_type' => $modelClass,
            'bookable_id' => $bookable->getKey(),
            'package_type' => $package ? get_class($package) : null,
            'package_id' => $package?->id,
            'horse_id' => $validated['horse_id'] ?? null,
            'date' => $validated['date'],
            'start_time' => $startTime,
            'duration' => $durationMinutes,
            'price' => $price,
            'status' => BookingStatus::PENDING,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Send Notification to Admins
        /** @var \Illuminate\Database\Eloquent\Collection $recipients */
        $recipients = \App\Models\User::where('type', \App\Enums\UserType::ADMIN)->get();

        foreach ($recipients as $recipient) {
            \Filament\Notifications\Notification::make()
                ->title('حجز جديد')
                ->body('تم إنشاء حجز جديد بواسطة ' . (Auth::user()?->name ?? 'مستخدم'))
                ->success()
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view')
                        ->label('عرض الحجز')
                        ->url(\App\Filament\Resources\BookingResource::getUrl('edit', ['record' => $booking])),
                ])
                ->sendToDatabase($recipient);
        }

        return redirect()->back()->with('success', __('bookings.created_successfully'));
    }
}
