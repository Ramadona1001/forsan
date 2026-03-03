@extends('layouts.app')

@section('title', $product->getTranslation('name', app()->getLocale()) . ' - خطى الفرسان')

@section('content')
    <!-- start single product-->
    <section class="main-section single-product">
        <div class="container">
            <!-- start breadcrumb-->
            <nav class="breadcrumb-parent" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">المنتجات</a></li>
                    <li class="breadcrumb-item active">{{ $product->getTranslation('name', app()->getLocale()) }}</li>
                </ol>
            </nav>
            <!-- end breadcrumb-->
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="single-product__gallery">
                        @include('partials.cards.compare-wishlist-buttons', [
                            'type' => 'product',
                            'id' => $product->id,
                            'isInWishlist' => in_array($product->id, session('wishlist_products', [])),
                            'isInCompare' => in_array($product->id, session('compare_products', [])),
                        ])
                        <div class="owl-carousel owl-theme single-product--carousel">
                            @if ($product->getMedia('gallery')->count() > 0)
                                @foreach ($product->getMedia('gallery') as $media)
                                    <div class="item"><img class="img-fluid" src="{{ $media->getUrl() }}"
                                            alt="{{ $product->name }}"></div>
                                @endforeach
                            @else
                                <div class="item"><img class="img-fluid fit-img"
                                        src="{{ $product->getFirstMediaUrl('main_image') ?: asset('images/products/1.webp') }}"
                                        alt="{{ $product->name }}"></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="single-product__info">
                        <div class="single-product__info__name">{{ $product->getTranslation('name', app()->getLocale()) }}
                        </div>

                        @if ($product->store)
                            <p class="text-muted mb-2">
                                <i class="bi bi-shop me-1"></i>
                                <a href="{{ route('stores.show', $product->store) }}" class="text-decoration-none text-muted">
                                    {{ $product->store->getTranslation('name', app()->getLocale()) }}
                                </a>
                            </p>
                        @endif

                        <div class="single-product__info__price">
                            <span class="price">{{ number_format($product->price) }} ريال </span>
                            @if ($product->compare_price && $product->compare_price > $product->price)
                                <span class="prev">{{ number_format($product->compare_price) }} ريال </span>
                                <span class="discount">-{{ $product->getDiscountPercentage() }}%</span>
                            @endif
                        </div>

                        @if ($product->description)
                            <div class="single-product__info__description">
                                {!! nl2br(e($product->getTranslation('description', app()->getLocale()))) !!}
                            </div>
                        @else
                            {{-- Fallback description if empty translation but data exists --}}
                            @php
                                $description = $product->getAttributes()['description'] ?? null;
                                if ($description && is_string($description)) {
                                    $decoded = json_decode($description, true);
                                    if (is_array($decoded)) {
                                        echo nl2br(e(reset($decoded)));
                                    }
                                }
                             @endphp
                        @endif

                        <form class="main-form" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            @if(isset($product->attributes['colors']) && is_array($product->attributes['colors']))
                                <div class="form-group">
                                    <label class="form-label">الالوان المتاحة</label>
                                    <div class="single-product__info__selectColor">
                                        @foreach($product->attributes['colors'] as $index => $color)
                                            @php
                                                $colorValue = is_array($color) ? ($color['value'] ?? $color) : $color;
                                            @endphp
                                            <label for="color-{{ $index }}">
                                                <span style="background-color: {{ $colorValue }};"></span>
                                            </label>
                                            <input type="radio" name="product_color" id="color-{{ $index }}"
                                                value="{{ $colorValue }}" hidden {{ $loop->first ? 'checked' : '' }}>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(isset($product->attributes['sizes']) && is_array($product->attributes['sizes']))
                                <div class="form-group">
                                    <label class="form-label">المقاسات المتاحة</label>
                                    <div class="single-product__info__selectSize">
                                        @foreach($product->attributes['sizes'] as $index => $size)
                                            <label for="size-{{ $index }}">{{ $size }}</label>
                                            <input type="radio" name="product_size" id="size-{{ $index }}" value="{{ $size }}"
                                                hidden {{ $loop->first ? 'checked' : '' }}>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label">السعر الكلي</label>
                                <div class="single-product__info__price"><span
                                        class="price">{{ number_format($product->price) }} ريال </span></div>
                            </div>

                            @if($product->sku)
                                <div class="mb-3 text-muted small">SKU: {{ $product->sku }}</div>
                            @endif

                            <div class="single-product__info__controllers">
                                @if (!$product->isOutOfStock())
                                    <button class="main-button main-primary fill w-100" type="submit">إضافة للسلة</button>
                                @else
                                    <button class="main-button main-primary fill w-100 disabled" type="button" disabled>غير
                                        متوفر</button>
                                @endif

                                @if (!$product->isOutOfStock())
                                    <div class="counter-parent">
                                        <input type="text" name="quantity" data-max="{{ $product->stock }}" data-min="1"
                                            value="1" hidden>
                                        <button class="decrement" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none">
                                                <path
                                                    d="M16 2H8C4 2 2 4 2 8V21C2 21.55 2.45 22 3 22H16C20 22 22 20 22 16V8C22 4 20 2 16 2Z"
                                                    stroke="#363636" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M8.5 12H15.5" stroke="#363636" stroke-width="1.5"
                                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </button><span class="value">1 </span>
                                        <button class="increment" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none">
                                                <path
                                                    d="M16 2H8C4 2 2 4 2 8V21C2 21.55 2.45 22 3 22H16C20 22 22 20 22 16V8C22 4 20 2 16 2Z"
                                                    stroke="#363636" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M8.5 12H15.5" stroke="#363636" stroke-width="1.5"
                                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                                <path d="M12 15.5V8.5" stroke="#363636" stroke-width="1.5"
                                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end single product-->

    <!-- start tabs section-->
    <section class="single-product__tabs">
        <div class="container">
            <div class="nav nav-pills" role="tablist">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-1" role="tab">الوصف</button>
            </div>
            <div class="tab-content mt-4" id="pills-tabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                    <div class="section-text">
                        {!! nl2br(e($product->getTranslation('description', app()->getLocale()))) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end tabs section-->

    <!-- Start related products-->
    @if ($relatedProducts->count() > 0)
        <section class="main-section main-slider bg-light">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head text-center line">منتجات ذات صله</h3>
                </div>
                <div class="main-section__wrapper">
                    <div class="owl-carousel owl-theme main-slider--carousel">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="item">
                                @include('partials.cards.product-card', ['product' => $relatedProduct])
                            </div>
                        @endforeach
                    </div>
                    <div class="custom-buttons">
                        <button class="custom-button-next"></button>
                        <button class="custom-button-prev"> </button>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End related products-->
@endsection