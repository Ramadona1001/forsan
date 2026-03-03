@extends('layouts.app')

@section('title', __('profile.booking_details') . ' - ' . config('app.name'))


@section('content')
    <section class="profile">
        <div class="container">
            <div class="profile__header">
                <button class="navbar-toggler shadow-none main-button main-primary fill" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#navbarUser">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <div class="row">
                <!-- Sidebar -->
                <div class="col-xl-4">
                    <div class="offcanvas-xl offcanvas-start" id="navbarUser">
                        <div class="offcanvas-header">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img class="img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                            </a>
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas"
                                data-bs-target="#navbarUser"></button>
                        </div>
                        <div class="offcanvas-body">
                            @include('profile.partials.sidebar')
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-xl-8">
                    <div class="profile__content tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" role="tabpanel">
                            <div class="profile__content__header d-flex justify-content-between align-items-center">
                                <h3>{{ __('profile.booking_details') }}</h3>

                                @php
                                    $statusClass = match ($booking->status->value) {
                                        'confirmed', 'completed' => 'paid',
                                        'pending' => 'un_paid',
                                        'cancelled' => 'un_paid',
                                        default => 'un_paid'
                                    };
                                @endphp
                                <div class="{{ $statusClass }}">{{ $booking->status->label() }}</div>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Booking Details Card -->
                            <div class="main-form mb-4">
                                <div class="row">
                                    <!-- Service Info -->
                                    <div class="col-md-6 mb-4">
                                        <h5 class="mb-3">{{ __('profile.service') }}</h5>

                                        <div class="d-flex align-items-start mb-3">
                                            @if($booking->bookable && $booking->bookable->getFirstMediaUrl('image'))
                                                <img src="{{ $booking->bookable->getFirstMediaUrl('image') }}"
                                                    class="rounded me-3"
                                                    style="width: 120px; height: 120px; object-fit: cover;">
                                            @else
                                                <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center"
                                                    style="width: 120px; height: 120px;">
                                                    <i class="bi bi-image fs-1 text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-2">
                                                    {{ $booking->bookable_display_name ?? __('profile.service_unavailable') }}
                                                </h6>
                                                @if($booking->package)
                                                    <span class="badge bg-info text-dark mb-2">
                                                        {{ __('profile.package') }}:
                                                        {{ $booking->package->getTranslation('name', app()->getLocale()) }}

                                                    </span>
                                                @endif
                                                @if($booking->bookable && method_exists($booking->bookable, 'provider') && $booking->bookable->provider)
                                                    <p class="text-muted mb-0 small">
                                                        <i class="bi bi-shop me-1"></i>
                                                        {{ $booking->bookable->provider->name ?? $booking->bookable->provider->user?->name }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Booking Info -->
                                    <div class="col-md-6 mb-4">
                                        <h5 class="mb-3">{{ __('profile.booking_details') }}</h5>

                                        <div class="booking-info-list">
                                            <div class="info-item d-flex justify-content-between mb-2 pb-2 border-bottom">
                                                <span class="text-muted">
                                                    <i class="bi bi-calendar3 me-2"></i>{{ __('profile.date') }}:

                                                </span>
                                                <span class="fw-bold">{{ $booking->date->format('Y-m-d') }}</span>
                                            </div>
                                            @if($booking->start_time)
                                                <div class="info-item d-flex justify-content-between mb-2 pb-2 border-bottom">
                                                    <span class="text-muted">
                                                        <i class="bi bi-clock me-2"></i>{{ __('profile.time') }}:

                                                    </span>
                                                    <span class="fw-bold">{{ $booking->start_time }}</span>
                                                </div>
                                            @endif
                                            @if($booking->duration)
                                                <div class="info-item d-flex justify-content-between mb-2 pb-2 border-bottom">
                                                    <span class="text-muted">
                                                        <i class="bi bi-hourglass-split me-2"></i>{{ __('profile.duration') }}:

                                                    </span>
                                                    <span class="fw-bold">{{ $booking->duration }}
                                                        {{ __('profile.minute') }}</span>

                                                </div>
                                            @endif
                                            <div class="info-item d-flex justify-content-between mb-2 pb-2 border-bottom">
                                                <span class="text-muted">
                                                    <i class="bi bi-cash me-2"></i>{{ __('profile.price') }}:

                                                </span>
                                                <span class="fw-bold text-success fs-5">{{ number_format($booking->price) }}
                                                    {{ __('profile.currency') }}</span>

                                            </div>
                                            <div class="info-item d-flex justify-content-between mb-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-hash me-2"></i>{{ __('profile.booking_id') }}:

                                                </span>
                                                <span class="fw-bold">{{ $booking->booking_number }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Horse Info -->
                                @if($booking->horse)
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <h5 class="mb-3">
                                                <i class="bi bi-star me-2"></i>{{ __('profile.horse') }}

                                            </h5>
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                @if($booking->horse->getFirstMediaUrl('main_image'))
                                                    <img src="{{ $booking->horse->getFirstMediaUrl('main_image') }}"
                                                        class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                                @else
                                                    <div class="rounded me-3 bg-white d-flex align-items-center justify-content-center"
                                                        style="width: 80px; height: 80px;">
                                                        <i class="bi bi-image fs-3 text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-1">
                                                        {{ $booking->horse->getTranslation('name', app()->getLocale()) }}</h6>
                                                    @if($booking->horse->breed)
                                                        <small class="text-muted">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            {{ $booking->horse->breed }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Notes -->
                                @if($booking->notes)
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <h5 class="mb-3">
                                                <i class="bi bi-sticky me-2"></i>{{ __('profile.notes') }}

                                            </h5>
                                            <div class="p-3 bg-light rounded">
                                                <p class="mb-0">{{ $booking->notes }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Actions -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ route('profile.bookings') }}"
                                                class="main-button main-secondary fill">
                                                <i class="bi bi-arrow-right me-2"></i>{{ __('profile.back_to_bookings') }}

                                            </a>

                                            @if($booking->canBeCancelled())
                                                <form action="{{ route('profile.bookings.cancel', $booking) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('{{ __('profile.confirm_cancel_booking') }}')">

                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="main-button main-trash fill">
                                                        <i class="bi bi-x-circle me-2"></i>{{ __('profile.cancel_booking') }}

                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .booking-info-list .info-item {
            transition: all 0.3s ease;
        }

        .booking-info-list .info-item:hover {
            background-color: #f8f9fa;
            padding-left: 10px;
            padding-right: 10px;
            margin-left: -10px;
            margin-right: -10px;
            border-radius: 5px;
        }
    </style>
@endsection