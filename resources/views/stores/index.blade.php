@extends('layouts.app')

@section('title', 'المتاجر - خطى الفرسان')

@section('content')
@extends('layouts.app')

@section('title', 'المتاجر - خطى الفرسان')

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
                                    <li class="breadcrumb-item active">المتاجر</li>
                                </ol>
                            </nav>
                            <!-- end breadcrumb-->
                        </div>
                        <div class="col-md-4 d-none d-md-block text-center"><img class="img-fluid"
                                src="{{ asset('images/icons/knight.svg') }}" alt="" title="" /></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end main-banner-->

        <!-- start stores-->
        <section class="main-section products">
            <div class="container">


                @if($stores->count() > 0)
                    <div class="row">
                        @foreach ($stores as $store)
                            <div class="col-lg-3 col-md-6">
                                <div class="main-card">
                                    <div class="main-card__img">
                                        <a href="{{ route('stores.show', $store) }}">
                                            <img class="product-img img-fluid"
                                                src="{{ $store->getFirstMediaUrl('cover') ?: asset('images/stores/1.webp') }}"
                                                alt="{{ $store->name }}">
                                        </a>
                                    </div>
                                    <div class="main-card__content">
                                        <a class="main-card__name" href="{{ route('stores.show', $store) }}">
                                            {{ $store->getTranslation('name', app()->getLocale()) }}
                                        </a>

                                        @if($store->rating)
                                            <div class="mb-2">
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-star-fill me-1"></i>{{ number_format($store->rating, 1) }}
                                                </span>
                                            </div>
                                        @endif

                                        <p class="main-card__description">
                                            {{ Str::limit($store->city . ' - ' . $store->address, 100) }}
                                        </p>
                                        <button class="main-button main-primary fill"
                                            onclick="window.location.href='{{ route('stores.show', $store) }}'">الدخول الي
                                            المتجر</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- start pagination-->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $stores->links() }}
                    </div>
                    <!-- end pagination-->
                @else
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i>لا توجد متاجر متاحة
                    </div>
                @endif
            </div>
        </section>
        <!-- end stores-->
    @endsection
@endsection
