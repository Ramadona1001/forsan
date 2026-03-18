@extends('admin.layouts.app')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">{{ __('Bookings') }}</h1>
    </div>

    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Booking Number') }}</th>
            <th>{{ __('User') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Price') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->booking_number }}</td>
                <td>{{ $booking->user?->name }}</td>
                <td>{{ $booking->date?->format('Y-m-d') }}</td>
                <td>{{ $booking->status->label() ?? $booking->status }}</td>
                <td>{{ number_format($booking->price, 2) }}</td>
                <td class="text-end">
                    <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                        {{ __('Show') }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('No bookings found.') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $bookings->links('pagination::bootstrap-4') }}
@endsection

