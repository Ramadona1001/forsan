@extends('admin.layouts.app')

@section('admin-content')
    <h1 class="h4 mb-4">{{ __('Admin Dashboard') }}</h1>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Users') }}</h5>
                    <p class="display-6">{{ $stats['users_count'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Services') }}</h5>
                    <p class="display-6">{{ $stats['services_count'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Categories') }}</h5>
                    <p class="display-6">{{ $stats['categories_count'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Bookings') }}</h5>
                    <p class="display-6">{{ $stats['bookings_count'] }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

