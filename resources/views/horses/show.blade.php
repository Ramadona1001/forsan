@extends('layouts.app')

@section('title', $horse->getTranslation('name', app()->getLocale()) . ' - خطى الفرسان')

@section('content')
    <!-- start single product-->
    <section class="main-section single-product" style="margin-top: 100px;">
        <div class="container">
            <!-- start breadcrumb-->
            <nav class="breadcrumb-parent" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('horses.index') }}">خدمة بيع الخيل</a></li>
                    <li class="breadcrumb-item active">{{ $horse->getTranslation('name', app()->getLocale()) }}</li>
                </ol>
            </nav>
            <!-- end breadcrumb-->
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="single-product__gallery">
                        @include('partials.cards.compare-wishlist-buttons', [
                            'type' => 'horse',
                            'id' => $horse->id,
                            'isInWishlist' => in_array($horse->id, session('wishlist_horses', [])),
                            'isInCompare' => in_array($horse->id, session('compare_horses', [])),
                        ])
                        <div class="owl-carousel owl-theme single-product--carousel">
                            <div class="item">
                                <a href="{{ $horse->getFirstMediaUrl('main_image') ?: 'https://via.placeholder.com/800x600' }}"
                                    data-fancybox="gallery">
                                    <img class="img-fluid"
                                        src="{{ $horse->getFirstMediaUrl('main_image') ?: 'https://via.placeholder.com/800x600' }}"
                                        alt="img">
                                </a>
                            </div>
                            @foreach($horse->getMedia('gallery') as $media)
                                <div class="item">
                                    <a href="{{ $media->getUrl() }}" data-fancybox="gallery">
                                        <img class="img-fluid" src="{{ $media->getUrl() }}" alt="img">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="single-product__info">
                        <div class="single-product__info__name">{{ $horse->getTranslation('name', app()->getLocale()) }}
                        </div>
                        <div class="single-product__info__price">
                            <span class="price">{{ number_format($horse->price) }} ريال </span>
                            @if($horse->is_for_rent && $horse->rent_price_per_day)
                                <span class="prev"> / {{ number_format($horse->rent_price_per_day) }} يومياً</span>
                            @endif
                            @if($horse->is_for_sale)
                                <span class="discount bg-success text-white px-2">للبيع</span>
                            @elseif($horse->is_for_rent)
                                <span class="discount bg-info text-white px-2">للإيجار</span>
                            @endif
                        </div>

                        <div class="single-product__info__description">
                            {!! \Illuminate\Support\Str::limit(strip_tags($horse->getTranslation('description', app()->getLocale())), 200) !!}
                        </div>

                        <ul class="single-product__info__items">
                            <li>العمر : <span>{{ $horse->age }} سنة</span></li>
                            @if($horse->gender)
                            <li>النوع : <span>{{ $horse->gender == 'male' ? 'ذكر' : 'أنثى' }}</span></li> @endif
                            @if($horse->color)
                            <li>اللون : <span>{{ $horse->color }}</span></li> @endif
                            @if($horse->height)
                            <li>الارتفاع : <span>{{ $horse->height }} سم</span></li> @endif
                            @if($horse->weight)
                            <li>الوزن : <span>{{ $horse->weight }} كجم</span></li> @endif
                            @if($horse->breed)
                            <li>السلالة : <span>{{ $horse->breed }}</span></li> @endif
                            @if($horse->stable)
                                <li>الإسطبل : <span>{{ $horse->stable->getTranslation('name', app()->getLocale()) }}</span></li>
                            @endif
                        </ul>

                        <div class="mt-4">
                            @if($horse->owner && $horse->owner->phone)
                                <div class="d-flex gap-2">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $horse->owner->phone) }}"
                                        target="_blank"
                                        class="main-button main-primary fill w-100 text-center text-decoration-none">
                                        <i class="bi bi-whatsapp me-2"></i> تواصل عبر واتساب
                                    </a>
                                    <a href="tel:{{ $horse->owner->phone }}"
                                        class="main-button main-secondary outline w-100 text-center text-decoration-none">
                                        <i class="bi bi-telephone me-2"></i> اتصال بالمالك
                                    </a>
                                </div>
                            @endif
                        </div>
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
                @if($horse->father_name || $horse->mother_name)
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-2" role="tab">النسب</button>
                @endif
                @if($horse->stable)
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-3" role="tab">معلومات الإسطبل</button>
                @endif
            </div>
            <div class="tab-content mt-4" id="pills-tabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                    <div class="section-text">
                        {!! nl2br(e($horse->getTranslation('description', app()->getLocale()))) !!}
                    </div>
                </div>
                @if($horse->father_name || $horse->mother_name)
                    <div class="tab-pane fade" id="tab-2" role="tabpanel">
                        <div class="main-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>الأب</th>
                                            <th>الأم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $horse->father_name ?? '-' }}</td>
                                            <td>{{ $horse->mother_name ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                @if($horse->stable)
                    <div class="tab-pane fade" id="tab-3" role="tabpanel">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <h5>{{ $horse->stable->getTranslation('name', app()->getLocale()) }}</h5>
                                <p class="mb-0 text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $horse->stable->city }},
                                    {{ $horse->stable->country }}</p>
                                <a href="{{ route('stables.show', $horse->stable) }}" class="btn btn-link px-0">عرض الإسطبل</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- end tabs section-->

    <!-- Start related products-->
    <section class="main-section main-slider bg-light">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head text-center line">خيول مشابهة</h3>
            </div>
            <div class="main-section__wrapper">
                @if($relatedHorses->count() > 0)
                    <div class="owl-carousel owl-theme main-slider--carousel">
                        @foreach($relatedHorses as $relatedHorse)
                            <div class="item">
                                @include('partials.cards.horse-card', ['horse' => $relatedHorse])
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">لا توجد خيول مشابهة حالياً.</p>
                @endif
            </div>
        </div>
    </section>
    <!-- End related products-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Re-initialize Fancybox if needed, although simple links should work
            Fancybox.bind("[data-fancybox]", {});

            // Note: owl-carousel is likely initialized in owl-init.js or script.js imported in layout
            // If specific initialization is needed for this page:
            /*
            $('.single-product--carousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: true,
                dots: true
            });
            */
        });
    </script>
@endpush