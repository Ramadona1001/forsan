@extends('layouts.app')

@php
    $locale = app()->getLocale();
    $pageTitle = $sport->getTranslation('title', $locale) ?: $sport->slug;
    $content = $sport->getTranslation('content', $locale);
    $sliderImages = $sport->getMedia('slider_images');
    $placeholderImage = asset('images/statec.webp');
@endphp

@section('title', $pageTitle . ' - ' . __('general.site_title'))

@section('content')
{{-- start information-about (صفحة رياضة فردية) --}}
<section class="information-about">
    <div class="container">
        <nav class="breadcrumb-parent" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('info.show', 'equestrian-sports-overview') }}">{{ __('general.equestrian_sports_overview') }}</a></li>
                <li class="breadcrumb-item active">{{ $pageTitle }}</li>
            </ol>
        </nav>
        <div class="owl-carousel owl-theme header-slider--carousel bordered">
            @forelse($sliderImages as $media)
                <div class="item">
                    <div class="information-about__img">
                        <img class="img-fluid" src="{{ $media->getUrl() }}" alt="{{ $pageTitle }}">
                    </div>
                </div>
            @empty
                <div class="item">
                    <div class="information-about__img">
                        <img class="img-fluid" src="{{ $sport->getFirstMediaUrl('image') ?: $placeholderImage }}" alt="{{ $pageTitle }}">
                    </div>
                </div>
            @endforelse
        </div>
        <div class="horizontal-wrapper">
            <h1 class="section-head">{{ $pageTitle }}</h1>
            @if($content)
                <div class="section-text">{!! $content !!}</div>
            @endif
        </div>
    </div>
</section>
{{-- end information-about --}}

@if(isset($otherSports) && $otherSports->isNotEmpty())
    {{-- الرياضات الباقية (ما عدا الرياضة الحالية) --}}
    <section class="main-section main-slider bg-light">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head text-center line">{{ __('general.sports') }}</h3>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme main-slider--carousel">
                    @foreach($otherSports as $other)
                        @php
                            $otherTitle = $other->getTranslation('title', $locale) ?: $other->slug;
                            $otherContent = $other->getTranslation('content', $locale);
                            $otherImage = $other->getFirstMediaUrl('image') ?: $placeholderImage;
                            $otherLink = route('info.sport.show', $other->slug);
                        @endphp
                        <div class="item">
                            <div class="main-card">
                                <div class="main-card__img">
                                    <a href="{{ $otherLink }}">
                                        <img class="product-img img-fluid" src="{{ $otherImage }}" alt="{{ $otherTitle }}" title="{{ $otherTitle }}">
                                    </a>
                                </div>
                                <div class="main-card__content">
                                    <a class="main-card__name" href="{{ $otherLink }}">{{ $otherTitle }}</a>
                                    @if($otherContent)
                                        <p class="main-card__description">{{ Str::limit(strip_tags($otherContent), 150) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
