@extends('layouts.app')

@php
    $locale = app()->getLocale();
    $pageTitle = $page->getTranslation('title', $locale) ?: $page->slug;
    $content = $page->getTranslation('content', $locale);
@endphp

@section('title', $pageTitle . ' - ' . __('general.site_title'))

@section('content')
@php
    $sliderImages = $page->getMedia('slider_images');
    $placeholderImage = asset('images/statec.webp');
@endphp


{{-- start information-about --}}
<section class="information-about">
    <div class="container">
        <nav class="breadcrumb-parent" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
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
                        <img class="img-fluid" src="{{ $placeholderImage }}" alt="{{ $pageTitle }}">
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

@if($page->template === \App\Models\InformationPage::TEMPLATE_WITH_TABLE && !empty($page->table_data))
    {{-- start information-about table --}}
    <section class="main-section information-about__table">
        <div class="container">
            @if($page->getTranslation('extra_section_title', $locale))
                <h2 class="section-head line">{{ $page->getTranslation('extra_section_title', $locale) }}</h2>
            @else
                <h2 class="section-head line">{{ __('info.table_heading_default') }}</h2>
            @endif
            <div class="main-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('info.table_type') }}</th>
                                <th scope="col">{{ __('info.table_date') }}</th>
                                <th scope="col">{{ __('info.table_time') }}</th>
                                <th scope="col">{{ __('info.table_place') }}</th>
                                <th scope="col">{{ __('info.table_details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($page->table_data as $row)
                                <tr>
                                    <td scope="row">{{ $row['type'] ?? '-' }}</td>
                                    <td>{{ $row['date'] ?? '-' }}</td>
                                    <td>{{ $row['time'] ?? '-' }}</td>
                                    <td>{{ $row['place'] ?? '-' }}</td>
                                    <td>
                                        @if(!empty($row['details']))
                                            <a href="{{ $row['details'] }}" target="_blank" rel="noopener">{{ $row['details'] }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    {{-- end information-about table --}}
@endif

@if($page->template === \App\Models\InformationPage::TEMPLATE_WITH_PRODUCTS_SLIDER && $products->isNotEmpty())
    {{-- start products slider (e.g. معايير السلامة - منتجات معتمدة من FEI) --}}
    <section class="main-section main-slider bg-light">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head text-center line">{{ $page->getTranslation('extra_section_title', $locale) ?: __('info.fei_products_heading') }}</h3>
            </div>
            <div class="owl-carousel owl-theme main-slider--carousel">
                @foreach($products as $product)
                    <div class="item">
                        @include('partials.cards.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- end products slider --}}
@endif

@if($page->template === \App\Models\InformationPage::TEMPLATE_WITH_SPORTS_SLIDER && $equestrianSports->isNotEmpty())
    {{-- start sports slider (من EquestrianSport في الداشبورد) --}}
    <section class="main-section main-slider bg-light">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head text-center line">{{ $page->getTranslation('extra_section_title', $locale) ?: __('general.sports') }}</h3>
            </div>
            <div class="main-section__wrapper">
                <div class="owl-carousel owl-theme main-slider--carousel">
                    @foreach($equestrianSports as $sport)
                        @php
                            $sportTitle = $sport->getTranslation('title', $locale) ?: $sport->slug;
                            $sportContent = $sport->getTranslation('content', $locale);
                            $sportImage = $sport->getFirstMediaUrl('image') ?: asset('images/statec.webp');
                            $sportLink = route('info.sport.show', $sport->slug);
                        @endphp
                        <div class="item">
                            <div class="main-card">
                                <div class="main-card__img">
                                    <a href="{{ $sportLink }}">
                                        <img class="product-img img-fluid" src="{{ $sportImage }}" alt="{{ $sportTitle }}" title="{{ $sportTitle }}">
                                    </a>
                                </div>
                                <div class="main-card__content">
                                    <a class="main-card__name" href="{{ $sportLink }}">{{ $sportTitle }}</a>
                                    @if($sportContent)
                                        <p class="main-card__description">{{ Str::limit(strip_tags($sportContent), 150) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- end sports slider --}}
@endif
@endsection
