@extends('layouts.app')

@php
    $locale = app()->getLocale();
    $collabTitle = $collaboration->getTranslation('title', $locale) ?: $collaboration->slug;
@endphp

@section('title', __('general.collaboration_request_breadcrumb') . ' - ' . config('app.name'))

@section('content')
<!-- start main-banner -->
<section class="pb-0">
    <div class="container">
        <div class="main-banner">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3 class="main-banner__head">"{{ __('general.collaboration_request_banner_quote') }}"</h3>
                    <nav class="breadcrumb-parent" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('collaboration.index') }}">{{ __('general.collaboration_breadcrumb') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('general.collaboration_request_breadcrumb') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end main-banner -->

<!-- start collaboration-request -->
<section class="main-service collaboration-request">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ __('general.collaboration_success_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
                <form class="main-form" action="{{ route('collaboration.submit', $collaboration->slug) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">{{ __('general.collaboration_form.name') }} *</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('general.collaboration_form.placeholder_name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">{{ __('general.collaboration_form.email') }}</label>
                        <div class="input-group">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('general.collaboration_form.placeholder_email') }}">
                            <span class="input-group-text">{{ __('general.optional') }}</span>
                        </div>
                        @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">{{ __('general.collaboration_form.phone') }}</label>
                        <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="{{ __('general.collaboration_form.placeholder_phone') }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="message">{{ __('general.collaboration_form.message') }} *</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="{{ __('general.collaboration_form.placeholder_message') }}" required>{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                        <label class="form-check-label" for="terms">{!! __('general.collaboration_form.terms_label', ['url' => route('pages.show', 'terms-conditions')]) !!}</label>
                        @error('terms')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <button class="main-button main-primary fill" type="submit">{{ __('general.collaboration_form.submit') }}</button>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="horizontal-wrapper">
                    <div class="inquiries">
                        <h3>{{ __('general.collaboration_inquiries_heading') }}</h3>
                        <img class="img-fluid" src="{{ asset('images/icons/inquiries.svg') }}" alt="" title="">
                        <a class="main-button main-primary fill" href="{{ route('contact') }}">{{ __('general.contact_us') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end collaboration-request -->
@endsection
