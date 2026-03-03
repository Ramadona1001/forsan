@extends('layouts.app')

@section('title', 'المنتجات - خطى الفرسان')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">المنتجات</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-funnel me-2"></i>فلترة المنتجات
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.index') }}" method="GET">
                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label">التصنيف</label>
                                <select name="category" class="form-select">
                                    <option value="">الكل</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->getTranslation('name', app()->getLocale()) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-3">
                                <label class="form-label">السعر</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control" placeholder="من"
                                            value="{{ request('min_price') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control" placeholder="إلى"
                                            value="{{ request('max_price') }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-1"></i>بحث
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                إعادة تعيين
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-bag me-2"></i>المنتجات ({{ $products->total() }})</h2>
                    <select class="form-select w-auto" onchange="window.location.href=this.value">
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'latest'])) }}"
                            {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>الأحدث</option>
                        <option
                            value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}"
                            {{ request('sort') == 'price_low' ? 'selected' : '' }}>السعر: من الأقل</option>
                        <option
                            value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}"
                            {{ request('sort') == 'price_high' ? 'selected' : '' }}>السعر: من الأعلى</option>
                        <option
                            value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'popular'])) }}" {{ request('sort') == 'popular' ? 'selected' : '' }}>الأكثر مبيعاً</option>
                    </select>
                </div>

                @if($products->count() > 0)
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4 col-sm-6 mb-4">
                                @include('partials.cards.product-card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i>لا توجد منتجات مطابقة
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection