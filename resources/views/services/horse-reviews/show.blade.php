@extends('layouts.app')

@section('title', $horseReview->title . ' - خطوات الفرسان')

@section('content')
    <!-- start main-banner-->
    <section class="pb-0">
        <div class="container">
            <div class="main-banner ">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="main-banner__head">
                            {{ $horseReview->title}}
                        </h3>
                        <!-- start breadcrumb-->
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('services.horse-reviews.index') }}">
                                        {{ __('services.horse_reviews') }}
                                    </a></li>
                                <li class="breadcrumb-item active">{{ $horseReview->title }}</li>
                            </ol>
                        </nav>
                        <!-- end breadcrumb-->
                    </div>
                    <div class="col-md-4 d-none d-md-block text-center"><img class="img-fluid"
                            src="{{ asset('images/icons/horse-w.svg') }}" alt="" title="" /></div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main-banner-->

    <!-- start horse reviews details-->
    <section class="main-service horses-reviews-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme header-slider--carousel bordered">
                        @if ($horseReview->hasMedia('gallery'))
                            @foreach ($horseReview->getMedia('gallery') as $media)
                                <div class="item">
                                    <div class="main-service__img"><img class="img-fluid" src="{{ $media->getUrl() }}"
                                            alt="{{ $horseReview->title }}"></div>
                                </div>
                            @endforeach
                        @elseif($horseReview->hasMedia('image'))
                            <div class="item">
                                <div class="main-service__img"><img class="img-fluid"
                                        src="{{ $horseReview->getFirstMediaUrl('image') }}" alt="{{ $horseReview->title }}">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="horizontal-wrapper">
                        <h3 class="section-head">{{ $horseReview->title }} <span class="price">{{ $horseReview->price }}
                                {{ __('services.price_sar') }}</span></h3>
                        <div class="section-text">
                            {!! $horseReview->description !!}
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="main-form" action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="bookable_type" value="horse_review">
                            <input type="hidden" name="bookable_id" value="{{ $horseReview->id }}">
                            <input id="form-coordinates-add" type="text" name="coordinates" hidden="">

                            <div class="form-group">
                                <label class="form-label">{{ __('services.available_appointments') }}</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input class="form-control main_range_picker" id="setDate" type="text" name="date"
                                            placeholder="{{ __('services.select_date') }}" data-format="YYYY-MM-DD"
                                            data-singledatepicker="true" readonly required>
                                        <i class="bi bi-calendar4-range" style="right: 25px; top: 10px;"></i>
                                    </div>
                                    <div class="col-4">
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
                                </div>
                            </div>

                            {{-- Optional: Location field if needed by backend, currently unused in controller but kept for
                            UI --}}
                            <label class="form-label">{{ __('services.location') }}</label>
                            <div class="form-group">
                                <input class="form-control" id="register-form-area-add" type="text" name="location"
                                    placeholder="{{ __('services.select_location') }}"><i class="bi bi-geo-alt"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{ __('services.notes') }}</label>
                                <textarea class="form-control" name="notes" rows="3"
                                    placeholder="{{ __('services.notes') }}"></textarea>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions"
                                    name="terms-conditions" value="true" required>
                                <label class="form-check-label" for="terms-conditions"> {{ __('services.agree_terms') }} <a
                                        href="#">{{ __('services.terms_conditions') }} </a></label>
                            </div>
                            <button class="main-button main-primary fill"
                                type="submit">{{ __('services.book_now') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end horse reviews details-->

    <!-- Dynamic Tabs/Sections -->
    @if ($horseReview->trainer_info)
        <!-- start Trainer Info -->
        <section class="main-service horses-reviews-details">
            <div class="container">
                <div class="row flex-xl-row flex-column-reverse">
                    <div class="col-lg-6">
                        <div class="horizontal-wrapper">
                            <h3 class="section-head">{{ __('services.about_trainer') }}</h3>
                            <div class="section-text">
                                {!! $horseReview->trainer_info !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if ($horseReview->hasMedia('trainer_image'))
                            <div class="main-service__img bordered">
                                <img class="img-fluid" src="{{ $horseReview->getFirstMediaUrl('trainer_image') }}" alt="Trainer">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- end Trainer Info -->
    @endif

    <!-- end Trainer Info -->

    <!-- start Related Services / Gallery -->
    <!-- Video Service Gallery Repeater -->
    @if ($horseReview->video_gallery && count($horseReview->video_gallery) > 0)
        <section class="main-section knight__gallery bg-light">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head text-center line">{{ __('services.reviews_gallery') }}</h3>
                </div>
                <div class="main-section__wrapper">
                    <div class="owl-carousel owl-theme two-items-carousel">
                        @foreach ($horseReview->video_gallery as $item)
                            <div class="item">
                                <a class="knight__gallery__item video" data-fancybox="gallery-knight"
                                    href="{{ $item['video_url'] }}">
                                    <div class="video__play">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4 11.9999V8.43989C4 4.01989 7.13 2.2099 10.96 4.4199L14.05 6.1999L17.14 7.9799C20.97 10.1899 20.97 13.8099 17.14 16.0199L14.05 17.7999L10.96 19.5799C7.13 21.7899 4 19.9799 4 15.5599V11.9999Z"
                                                stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    @if(isset($item['thumbnail']))
                                        <img class="img-fluid" src="{{ Storage::url($item['thumbnail']) }}" alt="" title="">
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="custom-buttons">
                        <button class="custom-button-next"> </button>
                        <button class="custom-button-prev"> </button>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($relatedHorses->isNotEmpty())
        <!-- start Related Services -->
        <section class="main-section knight__gallery bg-light">
            <div class="container">
                <div class="main-section__header">
                    <h3 class="section-head text-center line">{{ __('services.related_services') }}</h3>
                </div>
                <div class="main-section__wrapper">
                    <div class="owl-carousel owl-theme two-items-carousel">
                        @foreach($relatedHorses as $related)
                            <div class="item">
                                <a class="knight__gallery__item" href="{{ route('services.horse-reviews.show', $related->slug) }}">
                                    <img class="img-fluid" src="{{ $related->getFirstMediaUrl('image') }}"
                                        alt="{{ $related->title }}" title="{{ $related->title }}">
                                    <div class="caption text-center mt-2">
                                        <h5>{{ $related->title }}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- end Related Services -->
@endsection