@extends('layouts.app')

@section('title', ($pageTitle ?? 'استعراضات الخيل') . ' - ' . __('general.site_title'))

@section('content')
    <!-- start main-banner-->
    <section class="pb-0">
        <div class="container">
            <div class="main-banner ">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="main-banner__head">
                            {{ $pageDescription ?? __('services_description') }}
                        </h3>
                        <!-- start breadcrumb-->
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                                <li class="breadcrumb-item active">{{ $pageTitle }}</li>
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

    <!-- start horses-reviews -->
    <section class="main-service horses-reviews">
        <div class="container">
            <div class="main-service__wrapper">
                @forelse($services as $service)
                    <div class="main-card">
                        <div class="main-card__img">
                            <a href="{{ route('services.horse-reviews.show', $service->slug) }}">
                                <img class="product-img img-fluid" src="{{ $service->getFirstMediaUrl('image') }}"
                                    alt="{{ $service->title }}">
                            </a>
                        </div>
                        <div class="main-card__content">
                            <a class="main-card__name"
                                href="{{ route('services.horse-reviews.show', $service->slug) }}">{{ $service->title }}</a>
                            <p class="main-card__description">{!! Str::limit($service->description, 100) !!}</p>
                            <a class="main-button main-primary fill"
                                href="{{ route('services.horse-reviews.show', $service->slug) }}">{{ __('services.more') }}</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info w-100 text-center">{{ __('services.no_services_available') }}</div>
                @endforelse
            </div>

            <!-- start pagination-->
            @if ($services->hasPages())
                <div class="pagination">
                    {{ $services->links('pagination::bootstrap-4') }}
                </div>
            @endif
            <!-- end pagination-->
        </div>
    </section>
    <!-- end horses-reviews -->
@endsection