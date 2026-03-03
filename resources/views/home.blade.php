@extends('layouts.app')

@section('title', __('home.services') . ' - ' . config('app.name'))

@section('content')
    {{-- Header Slider --}}
    <section class="header-slider home">
        <div class="owl-carousel owl-theme header-slider--carousel">
            @forelse($sliders as $slider)
                <div class="item">
                    <a class="header-slider__slide" href="{{ $slider->link ?? '#' }}">
                        <img class="img-fluid" src="{{ $slider->getFirstMediaUrl('image') }}" alt="{{ $slider->title }}" title="{{ $slider->title }}">
                    </a>
                </div>
            @empty
                <div class="item">
                    <a class="header-slider__slide" href="#">
                        <img class="img-fluid" src="{{ asset('images/slider.svg') }}" alt="image" title="">
                    </a>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Services Slider --}}
    <div class="main-section services-slider home">
        <div class="container">
            <div class="main-section__wrapper">
                <h2 class="section-head text-center mb-3">{{ __('home.services') }}</h2>
                <p class="section-text mb-3 text-center">{{ __('home.services_desc') }}</p>
                <div class="services-slider__wrapper">
                    <div class="owl-carousel owl-theme services-slider--carousel">
                        @forelse($featuredServices as $service)
                            <div class="item">
                                <a class="services-slider__item" href="{{ $service['url'] }}">
                                    <div class="services-slider__item__img">
                                        <img class="img-fluid" src="{{ $service['image'] }}" alt="{{ $service['title'] }}" title="">
                                    </div>
                                    <p class="services-slider__item__text">{{ $service['title'] }}</p>
                                </a>
                            </div>

                        @empty
                            @for($i = 1; $i <= 6; $i++)
                                <div class="item">
                                    <a class="services-slider__item" href="#">
                                        <div class="services-slider__item__img">
                                            <img class="img-fluid" src="{{ asset('images/services/' . $i . '.webp') }}" alt="" title="">
                                        </div>
                                        <p class="services-slider__item__text">{{ __('home.services') }} {{ $i }}</p>
                                    </a>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                    <div class="custom-buttons">
                        <button class="custom-button-next"> </button>
                        <button class="custom-button-prev"> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Banners Top --}}
    @if($topBanners->isNotEmpty())
        <div class="main-banners">
            <div class="container">
                <div class="main-banners__wrapper">
                    @foreach($topBanners as $banner)
                        <a class="main-banners__item" href="{{ $banner->link ?? '#' }}">
                            <img class="img-fluid" src="{{ $banner->getFirstMediaUrl('image') }}" alt="{{ $banner->title }}" title="{{ $banner->title }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Horses for Sale --}}
    <section class="main-section main-slider">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head line">{{ __('home.horses_for_sale') }}</h3>
                <a class="main-button main-primary" href="{{ route('horses.index') }}?for_sale=1">{{ __('home.view_all') }}</a>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme main-slider--carousel">
                    @forelse($featuredHorses as $horse)
                        <div class="item">
@include('partials.cards.horse-card', ['horse' => $horse])
                        </div>
                    @empty
                        <div class="item">
                            <div class="text-center py-5"><p>{{ __('home.no_horses') }}</p></div>
                        </div>
                    @endforelse
                </div>
                <div class="custom-buttons">
                    <button class="custom-button-next"></button>
                    <button class="custom-button-prev"> </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Banners Single --}}
    @if($middleBanner)
        <div class="main-banners single">
            <div class="container">
                <div class="main-banners__wrapper">
                    <a class="main-banners__item" href="{{ $middleBanner->link ?? '#' }}">
                        <img class="img-fluid" src="{{ $middleBanner->getFirstMediaUrl('image') }}" alt="{{ $middleBanner->title }}" title="{{ $middleBanner->title }}">
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Latest Services & Products --}}
    <section class="main-section main-slider">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head line">{{ __('home.latest_services_products') }}</h3>
                <a class="main-button main-primary" href="{{ route('products.index') }}">{{ __('home.view_all') }}</a>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme main-slider--carousel">
                    @forelse($featuredProducts as $product)
                        <div class="item">
                            @include('partials.cards.product-card', ['product' => $product])
                        </div>
                    @empty
                        <div class="item">
                            <div class="text-center py-5"><p>{{ __('home.no_products') }}</p></div>
                        </div>
                    @endforelse
                </div>
                <div class="custom-buttons">
                    <button class="custom-button-next"></button>
                    <button class="custom-button-prev"> </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Best Selling Products --}}
    <section class="main-section main-slider">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head line">{{ __('home.best_selling') }}</h3>
                <a class="main-button main-primary" href="{{ route('products.index') }}">{{ __('home.view_all') }}</a>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme main-slider--carousel">
                    {{-- Reusing featured products for now to match design --}}
                     @forelse($featuredProducts as $product)
                        <div class="item">
                             @include('partials.cards.product-card', ['product' => $product])
                        </div>
                    @empty
                         <div class="item">
                            <div class="text-center py-5"><p>{{ __('home.no_products') }}</p></div>
                        </div>
                    @endforelse
                </div>
                <div class="custom-buttons">
                    <button class="custom-button-next"></button>
                    <button class="custom-button-prev"> </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Offers and Discounts --}}
    <section class="main-section main-slider bg-primary">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head line text-white">{{ __('home.offers_discounts') }}</h3>
                <a class="main-button main-primary" href="{{ route('products.index') }}">{{ __('home.view_all') }}</a>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme main-slider--carousel">
                    {{-- Filtering for offers --}}
                    @php
                        $offers = $featuredProducts->filter(function($p) { return $p->compare_price > $p->price; });
                        $offers = $offers->isEmpty() ? $featuredProducts : $offers;
                    @endphp
                     @forelse($offers as $product)
                        <div class="item">
                             @include('partials.cards.product-card', ['product' => $product])
                        </div>
                    @empty
                         <div class="item">
                            <div class="text-center py-5"><p>{{ __('home.no_products') }}</p></div>
                        </div>
                    @endforelse
                </div>
                <div class="custom-buttons">
                    <button class="custom-button-next"></button>
                    <button class="custom-button-prev"> </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Blogs --}}
    <section class="main-section blogs">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head line">{{ __('home.latest_blogs') }}</h3>
                <a class="all-link" href="{{ route('blogs.index') }}">{{ __('home.view_all') }}</a>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme blogs--carousel">
                    @forelse($latestBlogs as $blog)
                        <div class="item">
                            <div class="third-card">
                                <div class="third-card__img">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">
                                        <img class="product-img img-fluid" src="{{ $blog->getFirstMediaUrl('featured_image') ?: asset('images/default.webp') }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}">
                                    </a>
                                </div>
                                <div class="third-card__content">
                                    <h3 class="third-card__name">{{Str::limit($blog->getTranslation('title', app()->getLocale()), 50)}}</h3>
                                    <p class="third-card__date">{{ $blog->published_at?->format('d/m/Y') }}</p>
                                    <p class="third-card__description">{{ Str::limit(strip_tags($blog->getTranslation('content', app()->getLocale())), 100) }}</p>
                                    <a class="main-button main-primary fill" href="{{ route('blogs.show', $blog->slug) }}">{{ __('home.read_more') }}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="item">
                            <div class="text-center py-5"><p>{{ __('home.no_blogs') }}</p></div>
                        </div>
                    @endforelse
                </div>
                <div class="custom-buttons">
                    <button class="custom-button-next"></button>
                    <button class="custom-button-prev"> </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Partners --}}
    <section class="main-section partners">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head text-center line">{{ __('home.partners') }}</h3>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme partners--carousel">
                    @foreach($sponsors as $sponsor)
                        <div class="item">
                            <a class="partners__item" href="{{ $sponsor->link ?? '#' }}">
                                <img class="img-fluid" src="{{ $sponsor->getFirstMediaUrl('logo')}}" alt="{{ $sponsor->name }}">
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
@endsection