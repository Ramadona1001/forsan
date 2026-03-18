@extends('admin.layouts.app')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">{{ __('Booking Details') }}</h1>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">{{ __('Booking Number') }}</dt>
                <dd class="col-sm-9">{{ $booking->booking_number }}</dd>

                <dt class="col-sm-3">{{ __('User') }}</dt>
                <dd class="col-sm-9">{{ $booking->user?->name }}</dd>

                <dt class="col-sm-3">{{ __('Date') }}</dt>
                <dd class="col-sm-9">{{ $booking->date?->format('Y-m-d') }}</dd>

                <dt class="col-sm-3">{{ __('Status') }}</dt>
                <dd class="col-sm-9">{{ $booking->status->label() ?? $booking->status }}</dd>

                <dt class="col-sm-3">{{ __('Price') }}</dt>
                <dd class="col-sm-9">{{ number_format($booking->price, 2) }}</dd>

                <dt class="col-sm-3">{{ __('Bookable') }}</dt>
                <dd class="col-sm-9">{{ $booking->bookable_display_name ?? class_basename($booking->bookable_type) . ' #' . $booking->bookable_id }}</dd>
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="row g-3 align-items-end">
                @csrf
                @method('PUT')

                <div class="col-md-4">
                    <label class="form-label">{{ __('Update Status') }}</label>
                    <select name="status" class="form-select">
                        @foreach(\App\Enums\BookingStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected($booking->status === $status)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

