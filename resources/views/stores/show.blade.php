@extends('layouts.app')

@section('title', $store->getTranslation('name', app()->getLocale()) . ' - خطى الفرسان')

@section('content')
    <!-- start main-banner-->
    <section class="pb-0">
        <div class="container">
            <div class="main-banner ">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="main-banner__head">عروض خاصه علي منتجات الفرسان</h3>
                        <p class="main-banner__sale">تصل ال 20%</p>
                        <!-- start breadcrumb-->
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">المتاجر</a></li>
                                <li class="breadcrumb-item active">{{ $store->getTranslation('name', app()->getLocale()) }}</li>
                            </ol>
                        </nav>
                        <!-- end breadcrumb-->
                    </div>
                    <div class="col-md-4 d-none d-md-block text-center"><img class="img-fluid" src="{{ asset('images/icons/knight.svg') }}"
                            alt="" title="" /></div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main-banner-->

    <!-- start store details-->
    <section class="main-service pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="main-service__img bordered">
                        <img class="img-fluid fit-img"
                            src="{{ $store->getFirstMediaUrl('cover') ?: asset('images/stores/1.webp') }}"
                            alt="{{ $store->name }}">
                         {{-- Product controls from HTML (favorites/share) can go here if functionality exists --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="horizontal-wrapper">
                        <h3 class="section-head">{{ $store->getTranslation('name', app()->getLocale()) }}</h3>
                        <h4 class="section-head sm">معلومات المتجر</h4>
                        @php
                            $description = $store->getTranslation('description', app()->getLocale());
                            if (empty($description)) {
                                $description = $store->getTranslation('description', config('app.fallback_locale', 'en'));
                            }
                            // Fallback to first available translation if still empty and data exists
                            if (empty($description) && !empty($store->getAttributes()['description'])) {
                                $raw = json_decode($store->getAttributes()['description'], true);
                                if (is_array($raw)) {
                                    $description = reset($raw);
                                }
                            }
                        @endphp

                        @if(!empty($description))
                            <p class="section-text">
                                {!! nl2br(e($description)) !!}
                            </p>
                        @endif

                        <ul class="main-list services-list mt-3">
                            <li>
                                <p class="text"><i class="bi bi-geo-alt mx-2"></i>{{ $store->city }} - {{ $store->address }}</p>
                            </li>
                            <li>
                                <p class="text"><i class="bi bi-bag mx-2"></i>{{ $store->products_count }} منتج</p>
                            </li>
                            @if($store->rating)
                            <li>
                                <p class="text"><i class="bi bi-star-fill mx-2 text-warning"></i>{{ number_format($store->rating, 1) }}</p>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end store details-->

    <!-- start products-->
    <section class="main-section products">
        <div class="container">
            <h3 class="section-head line">منتجات المتجر</h3>
            
            @if($products->count() > 0)
                <div class="products__wrapper mt-0">
                    @foreach($products as $product)
                        <div class="main-card">
                            <div class="main-card__img">
                                <a href="{{ route('products.show', $product->id) }}">
                                    {{-- Use product image or placeholder --}}
                                    <img class="product-img img-fluid" 
                                         src="{{ $product->getFirstMediaUrl('main_image') ?: asset('images/products/1.webp') }}" 
                                         alt="{{ $product->name }}">
                                </a>
                                @include('partials.cards.compare-wishlist-buttons', [
                                    'type' => 'product',
                                    'id' => $product->id,
                                    'isInWishlist' => in_array($product->id, session('wishlist_products', [])),
                                    'isInCompare' => in_array($product->id, session('compare_products', [])),
                                ])
                            </div>
                            <div class="main-card__content">
                                <a class="main-card__name" href="#">
                                    {{ $product->getTranslation('name', app()->getLocale()) }}
                                </a>
                                <p class="main-card__price">
                                    {{ $product->price }} <span>ريال</span>
                                </p>
                                <p class="main-card__description">
                                    {{ Str::limit($product->getTranslation('description', app()->getLocale()), 100) }}
                                </p>
                                <button class="main-button main-primary fill">أضف إلى السلة</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>لا توجد منتجات متاحة حالياً في هذا المتجر
                </div>
            @endif
        </div>
    </section>
    <!-- end products-->
@endsection