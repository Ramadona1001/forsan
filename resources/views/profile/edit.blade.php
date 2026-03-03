@extends('layouts.app')

@section('title', __('profile.edit_profile') . ' - ' . config('app.name'))


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-4">
                @include('profile.partials.sidebar')
            </div>

            <div class="col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>{{ __('profile.edit_profile') }}</h5>

                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('profile.name') }} *</label>

                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('profile.email') }}</label>

                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                                <small class="text-muted">{{ __('profile.email_cannot_change') }}</small>

                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('profile.phone') }}</label>

                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">{{ __('profile.bio') }}</label>

                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio"
                                    rows="3">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check me-1"></i>{{ __('profile.save_changes') }}

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection