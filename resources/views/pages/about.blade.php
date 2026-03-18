@extends('layouts.app')

@section('title', 'من نحن - خطى الفرسان')

@section('content')
@php
    $locale = app()->getLocale();
    $aboutTitle = $about ? $about->getTranslation('about_title', $locale) : 'من نحن';
    $aboutContent = $about ? $about->getTranslation('about_content', $locale) : '';
    $visionTitle = $about ? $about->getTranslation('vision_title', $locale) : 'الرؤية';
    $visionContent = $about ? $about->getTranslation('vision_content', $locale) : '';
    $goalsTitle = $about ? $about->getTranslation('goals_title', $locale) : 'الأهداف';
    $goalsContent = $about ? $about->getTranslation('goals_content', $locale) : '';
    $quoteText = $about ? $about->getTranslation('quote_text', $locale) : 'لخيلُ معقودٌ في نواصيها الخيرُ إلى يومِ القيامةِ';
    $aboutImage = $about && $about->about_image ? asset('storage/' . $about->about_image) : asset('images/about-us.webp');
    $servicesHeading = $about?->getTranslation('services_heading', $locale) ?: __('general.our_services');
    $servicesSubtext = $about?->getTranslation('services_subtext', $locale) ?: __('general.services_subtext_default');
    $partnersHeading = $about?->getTranslation('partners_heading', $locale) ?: __('general.sponsors');
    $knightsHeading = $about?->getTranslation('knights_heading', $locale) ?: __('general.our_knights');
    $sportsHeading = $about?->getTranslation('sports_heading', $locale) ?: __('general.sports');
    $sportsSubtext = $about?->getTranslation('sports_subtext', $locale) ?: __('general.sports_subtext_default');
@endphp

<!-- start about-us -->
<section class="about-us">
    <div class="container">
        <nav class="breadcrumb-parent" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">من نحن</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-6">
                <div class="about-us__img bordered">
                    <img class="img-fluid" src="{{ $aboutImage }}" alt="{{ $aboutTitle }}" title="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="horizontal-wrapper">
                    <h3 class="section-head">{{ $aboutTitle }}</h3>
                    @if($aboutContent)
                        <div class="section-text">{!! $aboutContent !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end about-us -->

<!-- start Vision and goals -->
<section class="vision-goals">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-sm-8 col-10 offset-lg-5 offset-sm-4 offset-2">
                <div class="horizontal-wrapper">
                    <h3 class="section-head pinpoint">{{ $visionTitle }}</h3>
                    <p class="section-text">{{ $visionContent }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-10 offset-2">
                <div class="horizontal-wrapper">
                    <h3 class="section-head pinpoint">{{ $goalsTitle }}</h3>
                    <p class="section-text">{{ $goalsContent }}</p>
                </div>
            </div>
            <div class="col-xl-5 col-lg-4 text-center d-none d-lg-block">
                <img class="img-fluid" src="{{ asset('images/icons/fares.svg') }}" alt="" title="">
            </div>
        </div>
    </div>
</section>
<!-- end Vision and goals -->

<!-- start services slider -->
@if($featuredServices->count() > 0)
<section class="main-section services-slider">
    <div class="container">
        <h2 class="section-head text-center mb-3">{{ $servicesHeading }}</h2>
        <p class="section-text mb-3 text-center">{{ $servicesSubtext }}</p>
        <div class="main-section__wrapper">
            <div class="services-slider__wrapper">
                <div class="owl-carousel owl-theme sports-slider--carousel">
                    @foreach($featuredServices as $service)
                    <div class="item">
                        <a class="services-slider__item" href="{{ $service['url'] }}">
                            <div class="services-slider__item__img">
                                <img class="img-fluid" src="{{ $service['image'] ?: asset('images/services/1.webp') }}" alt="{{ $service['title'] }}" title="">
                            </div>
                            <p class="services-slider__item__text">{{ $service['title'] }}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="custom-buttons">
                    <button class="custom-button-next"> </button>
                    <button class="custom-button-prev"> </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- end services slider -->

<!-- Start Sponsors -->
@if($partners->count() > 0)
<section class="main-section partners">
    <div class="container">
        <div class="main-section__header">
            <h3 class="section-head line">{{ $partnersHeading }}</h3>
        </div>
        <div class="main-section__wrapper">
            <div class="owl-carousel owl-theme partners--carousel">
                @foreach($partners as $partner)
                <div class="item">
                    <a class="partners__item" href="{{ $partner->website ?? '#' }}" target="_blank" rel="noopener">
                        <img class="img-fluid" src="{{ $partner->getFirstMediaUrl('logo') ?: asset('images/brands/1.webp') }}" alt="{{ $partner->getTranslation('name', $locale) }}">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="custom-buttons">
                <button class="custom-button-next"> </button>
                <button class="custom-button-prev"> </button>
            </div>
        </div>
    </div>
</section>
@endif
<!-- End Sponsors -->

<!-- start about-us quotes -->
<div class="main-quote about-us__quote">
    <div class="container">
        <h3>{{ $quoteText }}</h3>
    </div>
</div>
<!-- end about-us quotes -->

<!-- Start Our knights -->
@if($knights->count() > 0)
<section class="main-section our-knights">
    <div class="container">
        <div class="main-section__header">
            <h3 class="section-head line">{{ $knightsHeading }}</h3>
        </div>
        <div class="main-section__wrapper">
            <div class="owl-carousel owl-theme our-knights--carousel">
                @foreach($knights as $knight)
                <div class="item">
                    <div class="second-card">
                        <div class="second-card__img">
                            <img class="img-fluid" src="{{ $knight->getFirstMediaUrl('image') ?: asset('images/our-knights/1.webp') }}" alt="{{ $knight->getTranslation('name', $locale) }}" title="">
                        </div>
                        <div class="second-card__content">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="second-card__name">{{ $knight->getTranslation('name', $locale) }}</h3>
                                @php
                                    $knightUrl = $knight->link ?: ($knight->slug ? route('knights.show', $knight->slug) : '#');
                                @endphp
                                <a class="second-card__link" href="{{ $knightUrl }}">إقراء المزيد</a>
                            </div>
                            <p class="second-card__description">{{ Str::limit($knight->getTranslation('description', $locale) ?? '', 180) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="custom-buttons">
                <button class="custom-button-next"> </button>
                <button class="custom-button-prev"> </button>
            </div>
        </div>
    </div>
</section>
@endif
<!-- End Our knights -->

<!-- start sports slider (من بيانات رياضات الفروسية) -->
@if(isset($equestrianSports) && $equestrianSports->isNotEmpty())
<section class="main-section services-slider">
    <div class="container">
        <h2 class="section-head text-center mb-3">{{ $sportsHeading }}</h2>
        <p class="section-text mb-3 text-center">{{ $sportsSubtext }}</p>
        <div class="main-section__wrapper">
            <div class="services-slider__wrapper">
                <div class="owl-carousel owl-theme sports-slider--carousel">
                    @foreach($equestrianSports as $sport)
                    @php
                        $sportTitle = $sport->getTranslation('title', $locale) ?: $sport->slug;
                        $sportImage = $sport->getFirstMediaUrl('image') ?: asset('images/statec.webp');
                        $sportLink = route('info.sport.show', $sport->slug);
                    @endphp
                    <div class="item">
                        <a class="services-slider__item" href="{{ $sportLink }}">
                            <div class="services-slider__item__img">
                                <img class="img-fluid" src="{{ $sportImage }}" alt="{{ $sportTitle }}" title="">
                            </div>
                            <p class="services-slider__item__text">{{ $sportTitle }}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="custom-buttons">
                    <button class="custom-button-next"> </button>
                    <button class="custom-button-prev"> </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- end sports slider -->
@endsection
