@extends('layouts.app')

@section('title', $stable->getTranslation('name', app()->getLocale()) . ' - خطى الفرسان')

@section('content')
    <!-- Start preloader-->
    <div class="preloader-parent">
        <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt=""></div>
    </div>
    <!-- End preloader-->

    <!-- start main-banner (cover) -->
    <section class="pb-0">
        <div class="container">
            <div class="main-banner has-background" style="background-image:url({{ $stable->getFirstMediaUrl('cover') ?: asset('images/stables.webp') }});">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('stables.index') }}">الإسطبلات</a></li>
                                <li class="breadcrumb-item active">{{ $stable->getTranslation('name', app()->getLocale()) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main-banner -->

    <!-- start stable - الحجز مع الإسطبل + تابات -->
    <section class="main-service stable pb-0">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head line">الحجز مع الإسطبل</h3>
            </div>
            <ul class="nav nav-tabs main-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-sessions" type="button" role="tab">حجز الحصص</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-level" type="button" role="tab">تحديد مستوى</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-packages" type="button" role="tab">باقات</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-visit" type="button" role="tab">زيارة ترفيهية</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="stableTabContent">
            {{-- تاب حجز الحصص (افتراضي) --}}
            <div class="tab-pane fade show active" id="tab-sessions" role="tabpanel">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="main-service__img bordered">
                                <img class="img-fluid" src="{{ $stable->getFirstMediaUrl('cover') ?: asset('images/stores/1.webp') }}" alt="{{ $stable->getTranslation('name', app()->getLocale()) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @include('stables.partials.stable-booking-content', ['stable' => $stable, 'booking_type' => 'sessions'])
                        </div>
                    </div>
                </div>
            </div>
            {{-- تاب تحديد مستوى --}}
            <div class="tab-pane fade" id="tab-level" role="tabpanel">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="main-service__img bordered">
                                <img class="img-fluid" src="{{ $stable->getFirstMediaUrl('cover') ?: asset('images/stores/1.webp') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @include('stables.partials.stable-booking-content', ['stable' => $stable, 'booking_type' => 'level'])
                        </div>
                    </div>
                </div>
            </div>
            {{-- تاب الباقات --}}
            <div class="tab-pane fade" id="tab-packages" role="tabpanel">
                <div class="container mb-3 mb-lg-4">
                    <div class="mainPackages">
                        <div class="main-section__wrapper">
                            @if(isset($packages) && $packages->count() > 0)
                                <div class="row g-4">
                                    @foreach($packages as $pkg)
                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="mainPackages__item {{ $pkg->is_recommended ? 'recommended' : '' }}">
                                                <div class="head">{{ $pkg->getTranslation('name', app()->getLocale()) ?: (is_array($pkg->name) ? (array_values($pkg->name)[0] ?? '') : $pkg->name) }}</div>
                                                <div class="text">{{ Str::limit($pkg->getTranslation('description', app()->getLocale()) ?: (is_array($pkg->description) ? (array_values($pkg->description)[0] ?? '') : $pkg->description ?? ''), 120) }}</div>
                                                <div class="price">{{ number_format($pkg->price ?? 0, 0) }} ريال</div>
                                                <div class="subtitle">المزايا</div>
                                                <ul class="main-list">
                                                    @foreach($pkg->features ?? [] as $f)
                                                        <li><p class="text">{{ $f }}</p></li>
                                                    @endforeach
                                                </ul>
                                                <a class="main-primary main-button fill" href="{{ route('stables.packages.show', [$stable, $pkg]) }}">اقرأ المزيد</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5 section-text">لا توجد باقات متاحة حالياً لهذا الإسطبل.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- تاب زيارة ترفيهية --}}
            <div class="tab-pane fade" id="tab-visit" role="tabpanel">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="main-service__img bordered">
                                <img class="img-fluid" src="{{ $stable->getFirstMediaUrl('cover') ?: asset('images/stores/1.webp') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @include('stables.partials.stable-booking-content', ['stable' => $stable, 'booking_type' => 'visit'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- الموقع -->
    @if($stable->latitude && $stable->longitude)
        <section class="main-section">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head line">الموقع</h3>
                </div>
                <div class="main-section__wrapper">
                    <iframe class="iframeMap w-100" style="height: 400px; border: 0;" src="https://www.google.com/maps?q={{ $stable->latitude }},{{ $stable->longitude }}&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
    @endif

    <!-- الصور والفيديوهات -->
    @php $galleryMedia = $stable->getMedia('gallery'); @endphp
    @if($galleryMedia->count() > 0)
        <section class="main-section knight__gallery">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head line">الصور والفيديوهات</h3>
                </div>
                <div class="main-section__wrapper">
                    <div class="row g-3">
                        @foreach($galleryMedia->take(12) as $media)
                            <div class="col-6 col-md-4 col-lg-2">
                                <a class="knight__gallery__item d-block" href="{{ $media->getUrl() }}" data-fancybox="stable-gallery" target="_blank">
                                    <img class="img-fluid w-100" style="object-fit: cover; height: 120px;" src="{{ $media->getUrl() }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- المدربون -->
    @if($stable->trainers->count() > 0)
        <section class="main-section main-slider">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head line">المدربون</h3>
                    <p class="section-text fw-bold">عدد المدربين: {{ $stable->trainers_count }} مدرب</p>
                </div>
                <div class="main-section__wrapper">
                    <div class="row g-4">
                        @foreach($stable->trainers->take(6) as $trainer)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <div class="main-card h-100">
                                    <div class="main-card__img">
                                        <img class="product-img img-fluid" src="{{ $trainer->getFirstMediaUrl() ?: asset('images/users/1.webp') }}" alt="">
                                    </div>
                                    <div class="main-card__content">
                                        <h3 class="main-card__name">{{ $trainer->user->name ?? 'مدرب' }}</h3>
                                        @if($trainer->rating)
                                            <ul class="main-rate">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <li><i class="bi bi-star{{ $i <= round($trainer->rating) ? '-fill' : '' }}"></i></li>
                                                @endfor
                                                <li><span>{{ number_format($trainer->rating, 1) }}</span></li>
                                            </ul>
                                        @endif
                                        @if($trainer->experience_years)
                                            <p class="main-card__description">الخبرة: {{ $trainer->experience_years }} سنوات</p>
                                        @endif
                                        <a class="main-button main-primary fill" href="{{ route('stables.show', $stable) }}">احجز مع المدرب</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- الخيول -->
    @if($stable->horses->count() > 0)
        <section class="main-section main-slider bg-light">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head line">خيول الإسطبل</h3>
                </div>
                <div class="main-section__wrapper">
                    <div class="row g-4">
                        @foreach($stable->horses->take(8) as $horse)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                @include('partials.cards.horse-card', ['horse' => $horse])
                            </div>
                        @endforeach
                    </div>
                    @if($stable->horses->count() > 8)
                        <div class="text-center mt-3">
                            <a href="{{ route('horses.index') }}" class="main-button main-primary outline">عرض كل الخيول</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- المرافق -->
    @if($stable->facilities && count($stable->facilities) > 0)
        <section class="main-section">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head line">المرافق</h3>
                </div>
                <div class="main-section__wrapper">
                    <ul class="list-unstyled row g-2 mb-0">
                        @foreach($stable->facilities as $facility)
                            <li class="col-md-6"><i class="bi bi-check-circle text-success me-2"></i><span class="section-text">{{ $facility }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var hash = window.location.hash;
    if (hash && hash.startsWith('#tab-')) {
        var tabEl = document.querySelector('button[data-bs-target="' + hash + '"]');
        if (tabEl) { var tab = new bootstrap.Tab(tabEl); tab.show(); }
    }
    var tabParam = new URLSearchParams(window.location.search).get('tab');
    if (tabParam === 'packages') {
        var pkgTab = document.querySelector('button[data-bs-target="#tab-packages"]');
        if (pkgTab) { var t = new bootstrap.Tab(pkgTab); t.show(); }
    }
});
</script>
@endpush
