@extends('layouts.app')

@section('title', __('general.contact.page_title') . ' - ' . config('app.name'))

@section('content')
@php
    $settings = $settings ?? \App\Models\SiteSetting::getSettings();
    $bannerHeading = $settings?->getContactBannerHeading();
    $addressLines = $settings?->getContactAddressLines() ?? [];
    $phone = $settings?->contact_phone;
    $whatsapp = $settings?->contact_whatsapp;
    $email = $settings?->contact_email;
    $workingHours = $settings?->getWorkingHoursText();
    $logoUrl = $settings?->getLogoUrl() ?? asset('images/icons/knight.svg');
@endphp
<!-- start main-banner -->
<section class="pb-0">
    <div class="container">
        <div class="main-banner">
            <div class="row align-items-center">
                <div class="col-md-8">
                    @if($bannerHeading)
                        <h4 class="main-banner__head">{{ $bannerHeading }}</h4>
                    @endif
                    <nav class="breadcrumb-parent" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('general.contact.breadcrumb') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 d-none d-md-block text-center">
                    <img class="img-fluid" src="{{ $logoUrl }}" alt="" title="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end main-banner -->

<!-- start contact-us -->
<section class="contact-us">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ __('general.contact.success_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row flex-lg-row flex-column-reverse">
            <div class="col-lg-6">
                <h5 class="section-head mb-4">{{ __('general.contact.send_message') }}</h5>
                <form class="main-form" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">{{ __('general.contact.name') }} *</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('general.contact.placeholder_name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="email">{{ __('general.contact.email') }} *</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('general.contact.placeholder_email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="phone">{{ __('general.contact.phone') }}</label>
                                <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="{{ __('general.contact.placeholder_phone') }}">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="subject">{{ __('general.contact.subject') }} *</label>
                                <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" id="subject" value="{{ old('subject') }}" placeholder="{{ __('general.contact.placeholder_subject') }}" required>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="message">{{ __('general.contact.message') }} *</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="5" placeholder="{{ __('general.contact.placeholder_message') }}" required>{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button class="main-button main-primary fill w-100" type="submit">{{ __('general.contact.submit') }}</button>
                </form>
            </div>

            <div class="col-lg-6">
                <div class="contact-us__box mb-4">
                    <h6 class="contact-us__box__head"><i class="bi bi-geo-alt me-2"></i>{{ __('general.contact.our_location') }}</h6>
                    <ul class="list-unstyled mb-0">
                        @forelse($addressLines as $line)
                            <li class="section-text">{{ $line }}</li>
                        @empty
                            <li class="section-text">—</li>
                        @endforelse
                    </ul>
                </div>
                <div class="contact-us__box mb-4">
                    <h6 class="contact-us__box__head"><i class="bi bi-telephone me-2"></i>{{ __('general.contact.contact_us_title') }}</h6>
                    <ul class="list-unstyled mb-0">
                        @if($phone)
                            <li>
                                <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-decoration-none d-flex align-items-center gap-2 py-1">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span>{{ $phone }}</span>
                                </a>
                            </li>
                        @endif
                        @if($whatsapp)
                            <li>
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}" target="_blank" rel="noopener" class="text-decoration-none d-flex align-items-center gap-2 py-1">
                                    <i class="bi bi-whatsapp"></i>
                                    <span>{{ __('general.contact.whatsapp') }}</span>
                                </a>
                            </li>
                        @endif
                        @if($email)
                            <li>
                                <a href="mailto:{{ $email }}" class="text-decoration-none d-flex align-items-center gap-2 py-1">
                                    <i class="bi bi-envelope-fill"></i>
                                    <span>{{ $email }}</span>
                                </a>
                            </li>
                        @endif
                        @if(!$phone && !$whatsapp && !$email)
                            <li class="section-text">—</li>
                        @endif
                    </ul>
                </div>
                <div class="contact-us__box">
                    <h6 class="contact-us__box__head"><i class="bi bi-clock me-2"></i>{{ __('general.contact.working_hours') }}</h6>
                    <div class="section-text">
                        @if($workingHours)
                            {!! nl2br(e($workingHours)) !!}
                        @else
                            —
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end contact-us -->
@endsection
