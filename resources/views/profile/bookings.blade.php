@extends('layouts.app')

@section('title', __('profile.my_bookings') . ' - ' . config('app.name'))


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
                            <div class="profile__content__header">
                                <h3>{{ __('profile.my_bookings') }}</h3>

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

                            <div class="history-table">
                                <!-- Main Filter -->
                                <div class="mainFilter">
                                    <a class="{{ request('status') ? '' : 'active' }}"
                                        href="{{ route('profile.bookings') }}">{{ __('profile.all') }}</a>

                                    <a class="{{ request('status') == 'pending' ? 'active' : '' }}"
                                        href="{{ route('profile.bookings', ['status' => 'pending']) }}">{{ __('profile.pending') }}</a>

                                    <a class="{{ request('status') == 'confirmed' ? 'active' : '' }}"
                                        href="{{ route('profile.bookings', ['status' => 'confirmed']) }}">{{ __('profile.confirmed') }}</a>

                                    <a class="{{ request('status') == 'completed' ? 'active' : '' }}"
                                        href="{{ route('profile.bookings', ['status' => 'completed']) }}">{{ __('profile.completed') }}</a>

                                </div>

                                @if($bookings->count() > 0)
                                    <div class="main-table">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('profile.service') }}</th>

                                                        <th scope="col">{{ __('profile.date') }}</th>

                                                        <th scope="col">{{ __('profile.time') }}</th>

                                                        <th scope="col">{{ __('profile.price') }}</th>

                                                        <th scope="col">{{ __('profile.status') }}</th>

                                                        <th scope="col">{{ __('profile.status') }}</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($bookings as $booking)
                                                        <tr>
                                                            <td scope="row">
                                                                @if($booking->bookable_display_name)
                                                                    <strong>{{ $booking->bookable_display_name }}</strong>
                                                                @else
                                                                    <strong>{{ __('profile.service_unavailable') }}</strong>
                                                                @endif
                                                                @if($booking->horse)
                                                                    <br><small class="text-muted">{{ __('profile.horse') }}:

                                                                        {{ $booking->horse->name }}</small>
                                                                @endif
                                                                @if($booking->package)
                                                                    <br><small
                                                                        class="badge bg-info text-dark">{{ __('profile.package') }}</small>

                                                                @endif
                                                            </td>
                                                            <td class="date">{{ $booking->date->format('Y-m-d') }}</td>
                                                            <td>{{ $booking->start_time ?? '-' }}</td>
                                                            <td>{{ number_format($booking->price) }} {{ __('profile.currency') }}
                                                            </td>

                                                            <td>
                                                                @php
                                                                    $statusClass = match ($booking->status->value) {
                                                                        'confirmed', 'completed' => 'paid',
                                                                        'pending' => 'un_paid',
                                                                        'cancelled' => 'un_paid',
                                                                        default => 'un_paid'
                                                                    };
                                                                @endphp
                                                                <div class="{{ $statusClass }}">{{ $booking->status->label() }}
                                                                </div>
                                                            </td>
                                                            <td class="options">
                                                                @if($booking->canBeCancelled())
                                                                    <form action="{{ route('profile.bookings.cancel', $booking) }}"
                                                                        method="POST" class="d-inline"
                                                                        onsubmit="return confirm('{{ __('profile.confirm_cancel_booking') }}')">

                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type="submit" class="main-button main-trash rgb"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            data-bs-title="{{ __('profile.cancel_booking') }}">

                                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998"
                                                                                    stroke="#292D32" stroke-width="1.5"
                                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                                </path>
                                                                                <path
                                                                                    d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97"
                                                                                    stroke="#292D32" stroke-width="1.5"
                                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                                </path>
                                                                                <path
                                                                                    d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001"
                                                                                    stroke="#292D32" stroke-width="1.5"
                                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                                </path>
                                                                                <path d="M10.33 16.5H13.66" stroke="#292D32"
                                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path d="M9.5 12.5H14.5" stroke="#292D32"
                                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                            </svg>
                                                                        </button>
                                                                    </form>
                                                                @endif

                                                                <a class="main-button main-primary fill"
                                                                    href="{{ route('profile.bookings.show', $booking) }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-title="{{ __('profile.booking_details') }}">

                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none">
                                                                        <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="mt-4">
                                        {{ $bookings->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                                            fill="none" class="mb-3">
                                            <path d="M12.37 8.87988H17.62" stroke="#cccccc" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.38 8.87988L7.13 9.62988L9.38 7.37988" stroke="#cccccc"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.37 15.8799H17.62" stroke="#cccccc" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.38 15.8799L7.13 16.6299L9.38 14.3799" stroke="#cccccc"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path
                                                d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                                stroke="#cccccc" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        <h4 class="mt-3">{{ __('profile.no_bookings') }}</h4>

                                        <p class="text-muted">{{ __('profile.no_bookings_yet') }}</p>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection