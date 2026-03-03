@extends('layouts.app')

@section('title', ($package->getTranslation('name', app()->getLocale()) ?: $package->title) . ' - خطى الفرسان')

@section('content')
    <!-- Start preloader-->
    <div class="preloader-parent">
        <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt=""></div>
    </div>
    <!-- End preloader-->

    <!-- start main-banner-->
    <section class="pb-0">
        <div class="container">
            <div class="main-banner">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3 class="main-banner__head">{{ $package->getTranslation('name', app()->getLocale()) ?: $package->title }}</h3>
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('stables.show', $stable) }}">الإسطبل</a></li>
                                <li class="breadcrumb-item active">تفاصيل الباقة</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main-banner-->

    <!-- start package-details-->
    <section class="main-service package-details">
        <div class="container">
            <div class="horizontal-wrapper">
                <div class="section-head">
                    تفاصيل عن الباقة
                    <p class="price">{{ number_format($package->price ?? 0, 0) }} ريال</p>
                </div>

                <div class="section-text mb-4">
                    {{ $package->getTranslation('description', app()->getLocale()) ?: (is_array($package->description) ? (array_values($package->description)[0] ?? '') : ($package->description ?? '')) }}
                </div>

                <div class="section-head text-secondary">المزايا</div>
                <ul class="main-list">
                    @forelse(($package->features ?? []) as $feature)
                        <li>
                            <div class="section-text text-secondary mb-3">{{ $feature }}</div>
                        </li>
                    @empty
                        <li>
                            <div class="section-text text-secondary mb-3">لا توجد مزايا مضافة لهذه الباقة حالياً.</div>
                        </li>
                    @endforelse
                </ul>

                @auth
                    <form class="main-form mt-4" action="{{ route('bookings.store') }}" method="POST" style="max-width: 800px; margin: 0 auto;">
                        @csrf
                        <input type="hidden" name="bookable_type" value="stable">
                        <input type="hidden" name="bookable_id" value="{{ $stable->id }}">
                        <input type="hidden" name="package_type" value="stable_package">
                        <input type="hidden" name="package_id" value="{{ $package->id }}">

                        <label class="form-label">برجاء تحديد ميعاد الحجز</label>
                        <div class="form-group">
                            <input class="form-control" type="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="start_time_pkg">وقت البداية</label>
                            <input class="form-control" id="start_time_pkg" type="time" name="start_time" value="{{ old('start_time', '09:00') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="duration_hours_pkg">عدد الساعات</label>
                            <input class="form-control" id="duration_hours_pkg" type="number" name="duration_hours" value="{{ old('duration_hours', 1) }}" min="1" max="24" placeholder="أدخل عدد الساعات" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="terms_accepted" id="terms_pkg" value="1" required>
                            <label class="form-check-label" for="terms_pkg">الموافقة على جميع <a href="{{ route('pages.show', ['slug' => 'terms']) }}" target="_blank">الشروط والأحكام</a></label>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success mb-3">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0 list-unstyled">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button class="main-primary main-button fill w-75 m-auto d-block" type="submit">احجز باقاتك الآن</button>
                    </form>
                @else
                    <a class="main-primary main-button fill w-75 m-auto d-block mt-4" href="{{ route('login') }}?redirect={{ urlencode(request()->url()) }}">
                        سجل الدخول لحجز الباقة
                    </a>
                @endauth
            </div>
        </div>
    </section>
    <!-- end package-details  -->
@endsection

