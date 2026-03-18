@extends('layouts.app')

@section('title', __('general.our_knights') . ' - ' . __('general.site_title'))

@section('content')
{{-- start main-banner --}}
<section class="pb-0">
    <div class="container">
        <div class="main-banner">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="main-banner__head">{{ __('general.our_knights') }}</h3>
                    <nav class="breadcrumb-parent" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('general.our_knights') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 d-none d-md-block text-center">
                    <img class="img-fluid" src="{{ asset('images/icons/knight.svg') }}" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- end main-banner --}}

{{-- start our knights --}}
<section class="main-section our-knights">
    <div class="container">
        <div class="main-section__header">
            <h3 class="section-head">{{ __('general.our_knights') }}</h3>
        </div>
        <div class="main-section__wrapper">
            <div class="row">
                @forelse($knights as $knight)
                    @php
                        $name = $knight->getTranslation('name', app()->getLocale());
                        $description = $knight->getTranslation('description', app()->getLocale());
                        $imageUrl = $knight->getFirstMediaUrl('image') ?: asset('images/statec.webp');
                    @endphp
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="second-card mb-2">
                            <div class="second-card__img">
                                <img class="img-fluid" src="{{ $imageUrl }}" alt="{{ $name }}" title="{{ $name }}">
                            </div>
                            <div class="second-card__content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="second-card__name">{{ $name }}</h3>
                                    <a class="second-card__link" href="{{ route('knights.show', $knight->slug) }}">{{ __('general.read_more') }}</a>
                                </div>
                                <p class="second-card__description">{{ Str::limit(strip_tags($description), 120) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center py-5">{{ __('general.no_results') }}</p>
                    </div>
                @endforelse
            </div>
            @if($knights->hasPages())
                <div class="pagination mt-4">
                    <p>{{ __('general.page') }} {{ $knights->currentPage() }} {{ __('general.of') }} {{ $knights->lastPage() }}</p>
                    <ul>
                        <li class="{{ $knights->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $knights->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>
                        </li>
                        @foreach ($knights->getUrlRange(1, $knights->lastPage()) as $page => $url)
                            <li class="{{ $page == $knights->currentPage() ? 'active' : '' }}">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="{{ $knights->hasMorePages() ? '' : 'disabled' }}">
                            <a href="{{ $knights->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
{{-- end our knights --}}
@endsection
