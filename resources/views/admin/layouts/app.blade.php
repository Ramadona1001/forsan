@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="list-group">
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                        {{ __('Users') }}
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="list-group-item list-group-item-action">
                        {{ __('Services') }}
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                        {{ __('Categories') }}
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="list-group-item list-group-item-action">
                        {{ __('Bookings') }}
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('admin-content')
            </div>
        </div>
    </div>
@endsection

