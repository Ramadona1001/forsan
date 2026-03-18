@extends('layouts.app')

@php
    $locale = app()->getLocale();
@endphp

@section('title', __('general.collaboration_breadcrumb') . ' - ' . config('app.name'))

@section('content')
<!-- start main-banner -->
<section class="pb-0">
    <div class="container">
        <div class="main-banner">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3 class="main-banner__head">"{{ __('general.collaboration_banner_quote') }}"</h3>
                    <nav class="breadcrumb-parent" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('general.collaboration_breadcrumb') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end main-banner -->

<!-- start Collaboration with other facilities -->
<section class="main-service collaboration">
    <div class="container">
        <div class="main-service__wrapper">
            @forelse($collaborations as $collab)
                @php
                    $title = $collab->getTranslation('title', $locale) ?: $collab->slug;
                    $description = $collab->getTranslation('description', $locale);
                    $linkText = $collab->getTranslation('link_text', $locale) ?: $title;
                    $imageUrl = $collab->getFirstMediaUrl('image') ?: asset('images/stores/1.webp');
                    $requestUrl = route('collaboration.request', $collab->slug);
                @endphp
                <div class="main-card">
                    <div class="main-card__img">
                        <img class="product-img img-fluid" src="{{ $imageUrl }}" alt="{{ $title }}">
                    </div>
                    <div class="main-card__content text-center">
                        <h3 class="main-card__name">{{ $title }}</h3>
                        @if($description)
                            <p class="section-text">{!! $description !!}</p>
                        @endif
                        <a class="link" href="{{ $requestUrl }}">{{ $linkText }}</a>
                    </div>
                </div>
            @empty
                <p class="section-text text-center py-5">{{ __('general.no_collaborations') }}</p>
            @endforelse
        </div>
    </div>
</section>
<!-- end Collaboration with other facilities -->
@endsection
