@extends('layouts.app')

@section('title', 'الإسطبلات - خطى الفرسان')

@section('content')
    <!-- Start preloader-->
    <div class="preloader-parent">
        <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt=""></div>
    </div>
    <!-- End preloader-->

    <!-- start main-banner-->
    <section class="pb-0">
        <div class="container">
            <div class="main-banner has-background" style="background-image:url({{ asset('images/stables.webp') }});">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3 class="main-banner__head">احجز مع الإسطبلات الآن! تجربة فريدة لرعاية خيلك</h3>
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item active">جميع الإسطبلات</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main-banner-->

    <!-- start stables (بنفس هيكل الـ HTML) -->
    <section class="main-section products">
        <div class="container">
            <div class="row">

                {{-- المحتوى - col-xxl-9 مثل الـ HTML --}}
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                        <h3 class="products__title">جميع الإسطبلات</h3>
                        <button class="main-button main-primary fill filter-toggler d-xxl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#productsFilters"><i class="bi bi-funnel"></i></button>
                    </div>
                    @if($stables->count() > 0)
                        <div class="products__wrapper">
                            @foreach($stables as $stable)
                                @include('partials.cards.stable-card', ['stable' => $stable])
                            @endforeach
                        </div>
                        <div class="pagination mt-4 d-flex justify-content-center">
                            {{ $stables->links() }}
                        </div>
                    @else
                        <div class="dropdown-cart__empty text-center py-5">
                            <i class="bi bi-building display-4 text-muted"></i>
                            <h3 class="mt-3">لا توجد إسطبلات متاحة</h3>
                            <a href="{{ route('home') }}" class="main-button main-primary fill mt-3">العودة للرئيسية</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- end stables-->
@endsection

@push('styles')
<style>
    /* شبكة الكروت مثل الـ HTML - products__wrapper يعرض main-card في grid */
    .main-section.products .products__wrapper {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
    }
    @media (min-width: 576px) {
        .main-section.products .products__wrapper { grid-template-columns: repeat(2, 1fr); }
    }
    @media (min-width: 768px) {
        .main-section.products .products__wrapper { grid-template-columns: repeat(3, 1fr); }
    }
    @media (min-width: 1200px) {
        .main-section.products .products__wrapper { grid-template-columns: repeat(4, 1fr); }
    }
</style>
@endpush
