@extends('layouts.app')

@section('title', $photography->title . ' - ' . __('general.app_name', ['default' => 'Knights']))

@section('content')
    <!-- start main-banner-->
    <section class="pb-0">
        <div class="container">
            <div class="main-banner ">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="main-banner__head">
                            {{ $photography->title }}
                        </h3>
                        <!-- start breadcrumb-->
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                                <li class="breadcrumb-item active">{{ $photography->title }}</li>
                            </ol>
                        </nav>
                        <!-- end breadcrumb-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main-banner-->

    <!-- start classical-photography-->
    <section class="main-service classical-photography pb-0 mb-5">
        <div class="container">
            <div class="main-section__header">
                <h3 class="section-head line">{{ $photography->title }}</h3>
            </div>
            <ul class="nav nav-tabs main-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                        role="tab">{{ __('services.photos') }}</button>
                </li>
                @if($photography->video_gallery && count($photography->video_gallery) > 0)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2" type="button"
                            role="tab">{{ __('services.videos') }}</button>
                    </li>
                @endif
                @if($photography->packages->count() > 0)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3" type="button"
                            role="tab">{{ __('services.packages') }}</button>
                    </li>
                @endif
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <!-- Photos Tab -->
            <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="owl-carousel owl-theme header-slider--carousel bordered">
                                @if ($photography->hasMedia('gallery'))
                                    @foreach ($photography->getMedia('gallery') as $media)
                                        <div class="item">
                                            <div class="main-service__img"><img class="img-fluid" src="{{ $media->getUrl() }}"
                                                    alt="{{ $photography->title }}"></div>
                                        </div>
                                    @endforeach
                                @elseif($photography->hasMedia('image'))
                                    <div class="item">
                                        <div class="main-service__img"><img class="img-fluid"
                                                src="{{ $photography->getFirstMediaUrl('image') }}"
                                                alt="{{ $photography->title }}"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="horizontal-wrapper">
                                <h3 class="section-head">{{ __('services.about_service') }}
                                    @if($photography->price)
                                        <span class="price">{{ $photography->price }} {{ __('services.currency_sar') }}</span>
                                    @endif
                                </h3>
                                <div class="section-text">
                                    {!! $photography->description !!}
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="main-form" action="{{ route('bookings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bookable_type" value="photography">
                                    <input type="hidden" name="bookable_id" value="{{ $photography->id }}">

                                    <label class="form-label">{{ __('services.location') }}</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="location"
                                            placeholder="{{ __('services.select_location') }}"><i class="bi bi-geo-alt"></i>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">{{ __('services.available_appointments') }}</label>
                                        <div class="row">
                                            <div class="col-8">
                                                <input class="form-control main_range_picker" type="text" name="date"
                                                    placeholder="{{ __('services.select_date') }}" data-format="YYYY-MM-DD"
                                                    data-singledatepicker="true" readonly required>
                                                <i class="bi bi-calendar4-range" style="right: 25px; top: 10px;"></i>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select" name="start_time" required>
                                                    <option selected disabled value="">{{ __('services.select_time') }}
                                                    </option>
                                                    @for ($i = 9; $i <= 22; $i++)
                                                        @php
                                                            $hour = $i > 12 ? $i - 12 : $i;
                                                            $ampm = $i >= 12 ? 'PM' : 'AM';
                                                            $value = sprintf('%02d:00', $i);
                                                            $display = sprintf('%02d:00 %s', $hour, $ampm);
                                                        @endphp
                                                        <option value="{{ $value }}">{{ $display }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">{{ __('services.notes') }}</label>
                                        <textarea class="form-control" name="notes" rows="3"
                                            placeholder="{{ __('services.notes') }}"></textarea>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms-conditions"
                                            name="terms-conditions" value="true" required>
                                        <label class="form-check-label" for="terms-conditions">
                                            {{ __('services.agree_terms') }} <a
                                                href="#">{{ __('services.terms_conditions') }} </a></label>
                                    </div>
                                    <button class="main-button main-primary fill"
                                        type="submit">{{ __('services.book_now') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Packages in Photos Tab -->
                @if($photography->packages->count() > 0)
                    <div class="mainPackages main-section bg-light mt-3 mt-lg-5">
                        <div class="container">
                            <div class="main-section__header">
                                <h3 class="section-head text-center line">{{ __('services.packages') }}</h3>
                            </div>
                            <div class="main-section__wrapper">
                                <div class="row">
                                    @foreach($photography->packages as $package)
                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="mainPackages__item">
                                                <div class="head">{{ $package->name }}</div>
                                                <div class="text">{!! $package->description !!}</div>
                                                <div class="price">{{ $package->price }} {{ __('services.currency_sar') }}</div>
                                                <div class="subtitle">{{ __('services.features') }}</div>
                                                @if($package->features)
                                                    <ul class="main-list">
                                                        @foreach($package->features as $feature)
                                                            <li>
                                                                <p class="text">{{ $feature }}</p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                <button class="main-primary main-button fill" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#packageBookingModal" data-package-id="{{ $package->id }}"
                                                    data-package-name="{{ $package->name }}"
                                                    data-package-price="{{ $package->price }}"
                                                    onclick="setPackageData(this)">{{ __('services.book_package') }}</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Videos Tab -->
            @if($photography->video_gallery && count($photography->video_gallery) > 0)
                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="owl-carousel owl-theme header-slider--carousel bordered">
                                    @foreach($photography->video_gallery as $video)
                                        <div class="item">
                                            <a class="main-service__img" data-fancybox="vr-gallery"
                                                href="{{ $video['video_url'] ?? '#' }}">
                                                <div class="video__play">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4 11.9999V8.43989C4 4.01989 7.13 2.2099 10.96 4.4199L14.05 6.1999L17.14 7.9799C20.97 10.1899 20.97 13.8099 17.14 16.0199L14.05 17.7999L10.96 19.5799C7.13 21.7899 4 19.9799 4 15.5599V11.9999Z"
                                                            stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </div>
                                                @if(isset($video['thumbnail']))
                                                    <img class="img-fluid" src="{{ Storage::url($video['thumbnail']) }}" alt="">
                                                @else
                                                    <img class="img-fluid"
                                                        src="{{ asset('images/services/photography-services.webp') }}" alt="">
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="horizontal-wrapper">
                                    <h3 class="section-head">{{ __('services.about_service') }}
                                        @if($photography->price)
                                            <span class="price">{{ $photography->price }} {{ __('services.currency_sar') }}</span>
                                        @endif
                                    </h3>
                                    <div class="section-text">
                                        {!! $photography->description !!}
                                    </div>

                                    @if(session('success'))
                                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                    @endif
                                    @if(session('error'))
                                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-3">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form class="main-form" action="{{ route('bookings.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="bookable_type" value="photography">
                                        <input type="hidden" name="bookable_id" value="{{ $photography->id }}">

                                        <label class="form-label">{{ __('services.location') }}</label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location"
                                                placeholder="{{ __('services.select_location') }}"><i class="bi bi-geo-alt"></i>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ __('services.available_appointments') }}</label>
                                            <div class="row">
                                                <div class="col-8">
                                                    <input class="form-control main_range_picker" type="text" name="date"
                                                        placeholder="{{ __('services.select_date') }}" data-format="YYYY-MM-DD"
                                                        data-singledatepicker="true" readonly required>
                                                    <i class="bi bi-calendar4-range" style="right: 25px; top: 10px;"></i>
                                                </div>
                                                <div class="col-4">
                                                    <select class="form-select" name="start_time" required>
                                                        <option selected disabled value="">{{ __('services.select_time') }}
                                                        </option>
                                                        @for ($i = 9; $i <= 22; $i++)
                                                            @php
                                                                $hour = $i > 12 ? $i - 12 : $i;
                                                                $ampm = $i >= 12 ? 'PM' : 'AM';
                                                                $value = sprintf('%02d:00', $i);
                                                                $display = sprintf('%02d:00 %s', $hour, $ampm);
                                                            @endphp
                                                            <option value="{{ $value }}">{{ $display }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('services.notes') }}</label>
                                            <textarea class="form-control" name="notes" rows="3"
                                                placeholder="{{ __('services.notes') }}"></textarea>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms-conditions-video"
                                                name="terms-conditions" value="true" required>
                                            <label class="form-check-label" for="terms-conditions-video">
                                                {{ __('services.agree_terms') }} <a
                                                    href="#">{{ __('services.terms_conditions') }} </a></label>
                                        </div>
                                        <button class="main-button main-primary fill"
                                            type="submit">{{ __('services.book_now') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Packages in Videos Tab -->
                    @if($photography->packages->count() > 0)
                        <div class="mainPackages main-section bg-light mt-3 mt-lg-5">
                            <div class="container">
                                <div class="main-section__header">
                                    <h3 class="section-head text-center line">{{ __('services.packages') }}</h3>
                                </div>
                                <div class="main-section__wrapper">
                                    <div class="row">
                                        @foreach($photography->packages as $package)
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                <div class="mainPackages__item">
                                                    <div class="head">{{ $package->name }}</div>
                                                    <div class="text">{!! $package->description !!}</div>
                                                    <div class="price">{{ $package->price }} {{ __('services.currency_sar') }}</div>
                                                    <div class="subtitle">{{ __('services.features') }}</div>
                                                    @if($package->features)
                                                        <ul class="main-list">
                                                            @foreach($package->features as $feature)
                                                                <li>
                                                                    <p class="text">{{ $feature }}</p>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                    <button class="main-primary main-button fill" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#packageBookingModal"
                                                        data-package-id="{{ $package->id }}"
                                                        data-package-name="{{ $package->name }}"
                                                        data-package-price="{{ $package->price }}"
                                                        onclick="setPackageData(this)">{{ __('services.book_package') }}</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Packages Tab -->
            @if($photography->packages->count() > 0)
                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                    <div class="mainPackages main-section bg-light mt-3 mt-lg-5">
                        <div class="container">
                            <div class="main-section__header">
                                <h3 class="section-head text-center line">{{ __('services.packages') }}</h3>
                            </div>
                            <div class="main-section__wrapper">
                                <div class="row">
                                    @foreach($photography->packages as $package)
                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="mainPackages__item">
                                                <div class="head">{{ $package->name }}</div>
                                                <div class="text">{!! $package->description !!}</div>
                                                <div class="price">{{ $package->price }} {{ __('services.currency_sar') }}</div>
                                                <div class="subtitle">{{ __('services.features') }}</div>
                                                @if($package->features)
                                                    <ul class="main-list">
                                                        @foreach($package->features as $feature)
                                                            <li>
                                                                <p class="text">{{ $feature }}</p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                <button class="main-primary main-button fill" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#packageBookingModal"
                                                    data-package-id="{{ $package->id }}"
                                                    data-package-name="{{ $package->name }}"
                                                    data-package-price="{{ $package->price }}"
                                                    onclick="setPackageData(this)">{{ __('services.book_package') }}</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- end classical-photography-->

    <!-- Package Booking Modal -->
    <div class="modal fade" id="packageBookingModal" tabindex="-1" aria-labelledby="packageBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageBookingModalLabel">{{ __('services.book_package') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="bookable_type" value="photography">
                    <input type="hidden" name="bookable_id" value="{{ $photography->id }}">
                    <input type="hidden" name="package_type" value="photography_package" id="modal_package_type">
                    <input type="hidden" name="package_id" id="modal_package_id">

                    <div class="modal-body">
                        <div class="alert alert-info">
                            <strong id="selected_package_name"></strong><br>
                            <span>{{ __('services.price') }}: </span><span id="selected_package_price"></span> {{ __('services.currency_sar') }}
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('services.location') }}</label>
                            <input class="form-control" type="text" name="location" placeholder="{{ __('services.select_location') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('services.booking_date') }}</label>
                            <input class="form-control main_range_picker" type="text" name="date"
                                placeholder="{{ __('services.select_date') }}" data-format="YYYY-MM-DD"
                                data-singledatepicker="true" readonly required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('services.select_time') }}</label>
                            <select class="form-select" name="start_time" required>
                                <option selected disabled value="">{{ __('services.select_time') }}</option>
                                @for ($i = 9; $i <= 22; $i++)
                                    @php
                                        $hour = $i > 12 ? $i - 12 : $i;
                                        $ampm = $i >= 12 ? 'PM' : 'AM';
                                        $value = sprintf('%02d:00', $i);
                                        $display = sprintf('%02d:00 %s', $hour, $ampm);
                                    @endphp
                                    <option value="{{ $value }}">{{ $display }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('services.notes') }}</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="{{ __('services.notes') }}"></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="modal-terms-conditions"
                                name="terms-conditions" value="true" required>
                            <label class="form-check-label" for="modal-terms-conditions">
                                {{ __('services.agree_terms') }} <a href="#">{{ __('services.terms_conditions') }}</a>
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('general.cancel') }}</button>
                        <button type="submit" class="main-button main-primary fill">{{ __('services.book_now') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function setPackageData(button) {
    const packageId = button.getAttribute('data-package-id');
    const packageName = button.getAttribute('data-package-name');
    const packagePrice = button.getAttribute('data-package-price');

    document.getElementById('modal_package_id').value = packageId;
    document.getElementById('selected_package_name').textContent = packageName;
    document.getElementById('selected_package_price').textContent = packagePrice;
}
</script>
@endpush