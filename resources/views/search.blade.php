@extends('layouts.app')

@section('title', 'نتائج البحث: ' . $query . ' - خطى الفرسان')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">
            <i class="bi bi-search me-2"></i>نتائج البحث عن: "{{ $query }}"
        </h2>

        @if($horses->count() == 0 && $services->count() == 0 && $products->count() == 0 && $stables->count() == 0)
            <div class="alert alert-info text-center py-5">
                <i class="bi bi-search display-1 text-muted"></i>
                <h4 class="mt-3">لا توجد نتائج مطابقة</h4>
                <p class="text-muted">جرب البحث بكلمات مختلفة</p>
            </div>
        @else

            <!-- Horses Results -->
            @if($horses->count() > 0)
                <div class="search-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4><i class="bi bi-heart me-2"></i>الخيول ({{ $horses->count() }})</h4>
                        <a href="{{ route('horses.index', ['search' => $query]) }}" class="main-button main-primary outline">{{ __('general.view_all') }}</a>
                    </div>
                    <div class="row">
                        @foreach($horses->take(4) as $horse)
                            <div class="col-lg-3 col-md-6 mb-3">
                                @include('partials.cards.horse-card', ['horse' => $horse])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Services Results -->
            @if($services->count() > 0)
                <div class="search-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4><i class="bi bi-grid me-2"></i>الخدمات ({{ $services->count() }})</h4>
                        <a href="{{ route('services.horse-reviews.index', ['search' => $query]) }}" class="main-button main-primary outline">{{ __('general.view_all') }}</a>
                    </div>
                    <div class="row">
                        @foreach($services->take(4) as $service)
                            <div class="col-lg-3 col-md-6 mb-3">
                                @include('partials.cards.service-card', ['service' => $service])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Products Results -->
            @if($products->count() > 0)
                <div class="search-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4><i class="bi bi-bag me-2"></i>المنتجات ({{ $products->count() }})</h4>
                        <a href="{{ route('products.index', ['search' => $query]) }}" class="main-button main-primary outline">{{ __('general.view_all') }}</a>
                    </div>
                    <div class="row">
                        @foreach($products->take(4) as $product)
                            <div class="col-lg-3 col-md-6 mb-3">
                                @include('partials.cards.product-card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Stables Results -->
            @if($stables->count() > 0)
                <div class="search-section mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4><i class="bi bi-building me-2"></i>الإسطبلات ({{ $stables->count() }})</h4>
                        <a href="{{ route('stables.index', ['search' => $query]) }}" class="main-button main-primary outline">{{ __('general.view_all') }}</a>
                    </div>
                    <div class="row">
                        @foreach($stables->take(3) as $stable)
                            <div class="col-lg-4 col-md-6 mb-3">
                                @include('partials.cards.stable-card', ['stable' => $stable])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @endif
    </div>
@endsection