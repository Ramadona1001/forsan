@extends('layouts.app')

@section('title', 'مقارنة')

@section('content')
    <!-- Start preloader-->
    <div class="preloader-parent">
        <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="">
        </div>
    </div>
    <!-- End preloader-->

    <!-- start compare-->
    <section class="main-section compare-page">
        <div class="container">
            <div class="main-section__header">
                <nav class="breadcrumb-parent" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">مقارنة</li>
                    </ol>
                </nav>
            </div>

            <div class="compare-content">
                @if($products->isEmpty() && $horses->isEmpty() && ($services ?? collect())->isEmpty())
                    <div class="empty-compare text-center py-5">
                        <i class="bi bi-arrow-left-right text-muted display-1"></i>
                        <h3 class="mt-3">لا يوجد عناصر للمقارنة</h3>
                        <a href="{{ route('products.index') }}" class="main-button main-primary mt-3">تصفح المنتجات</a>
                        <a href="{{ route('horses.index') }}" class="main-button main-primary outline mt-3 ms-2">تصفح الخيول</a>
                        <a href="{{ route('services.horse-reviews.index') }}" class="main-button main-primary outline mt-3 ms-2">الخدمات</a>
                    </div>
                @else
                    @php $services = $services ?? collect(); @endphp
                    <ul class="nav nav-tabs compare-tabs mb-4 flex-nowrap" id="compareTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $products->isNotEmpty() ? 'active' : '' }}" id="products-tab" data-bs-toggle="tab" data-bs-target="#compare-products" type="button" role="tab" aria-controls="compare-products" aria-selected="{{ $products->isNotEmpty() ? 'true' : 'false' }}">
                                مقارنة المنتجات
                                @if($products->isNotEmpty())
                                    <span class="badge bg-primary ms-1">{{ $products->count() }}</span>
                                @endif
                            </button>
                        <br>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $products->isEmpty() && $horses->isNotEmpty() ? 'active' : '' }}" id="horses-tab" data-bs-toggle="tab" data-bs-target="#compare-horses" type="button" role="tab" aria-controls="compare-horses" aria-selected="{{ $products->isEmpty() && $horses->isNotEmpty() ? 'true' : 'false' }}">
                                مقارنة الخيول
                                @if($horses->isNotEmpty())
                                    <span class="badge bg-primary ms-1">{{ $horses->count() }}</span>
                                @endif
                            </button>
                        <br>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $products->isEmpty() && $horses->isEmpty() && $services->isNotEmpty() ? 'active' : '' }}" id="services-tab" data-bs-toggle="tab" data-bs-target="#compare-services" type="button" role="tab" aria-controls="compare-services" aria-selected="{{ $products->isEmpty() && $horses->isEmpty() && $services->isNotEmpty() ? 'true' : 'false' }}">
                                مقارنة الخدمات
                                @if($services->isNotEmpty())
                                    <span class="badge bg-primary ms-1">{{ $services->count() }}</span>
                                @endif
                            </button>
                        <br>

                        </li>
                    </ul>

                    <div class="tab-content" id="compareTabsContent">
                        <div class="tab-pane fade {{ $products->isNotEmpty() ? 'show active' : '' }}" id="compare-products" role="tabpanel" aria-labelledby="products-tab">
                            @if($products->isNotEmpty())
                                <div class="row g-4">
                                    @foreach($products as $product)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                            @include('partials.cards.product-card', ['product' => $product])
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-compare text-center py-5">
                                    <i class="bi bi-bag text-muted display-4"></i>
                                    <p class="mt-3">لا يوجد منتجات في المقارنة</p>
                                    <a href="{{ route('products.index') }}" class="main-button main-primary mt-2">تصفح المنتجات</a>
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane fade {{ $products->isEmpty() && $horses->isNotEmpty() ? 'show active' : '' }}" id="compare-horses" role="tabpanel" aria-labelledby="horses-tab">
                            @if($horses->isNotEmpty())
                                <div class="row g-4">
                                    @foreach($horses as $horse)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                            @include('partials.cards.horse-card', ['horse' => $horse])
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-compare text-center py-5">
                                    <i class="bi bi-star text-muted display-4"></i>
                                    <p class="mt-3">لا يوجد خيول في المقارنة</p>
                                    <a href="{{ route('horses.index') }}" class="main-button main-primary mt-2">تصفح الخيول</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- end compare-->

    @push('styles')
    <style>
        .compare-page .compare-content { max-width: 100%; }
        .compare-page .compare-tabs { border-bottom: 2px solid #dee2e6; }
        .compare-page .compare-tabs .nav-link { font-weight: 600; padding: 0.75rem 1.25rem; }
        .compare-page .compare-tabs .nav-link.active { border-color: #dee2e6 #dee2e6 #fff; }
        .compare-page .main-card { height: 100%; display: flex; flex-direction: column; }
        .compare-page .main-card__content { flex: 1; display: flex; flex-direction: column; }
        .compare-page .main-card__content .main-button { margin-top: auto; }
    </style>
    @endpush
@endsection
