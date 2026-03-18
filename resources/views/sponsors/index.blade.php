@extends('layouts.app')

@section('title', __('general.sponsors') . ' - ' . __('general.site_title'))

@section('content')
{{-- start main-banner --}}
<section class="pb-0">
    <div class="container">
        <div class="main-banner">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="main-banner__head">{{ __('general.sponsors') }}</h3>
                    <nav class="breadcrumb-parent" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('general.sponsors') }}</li>
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

{{-- start sponsors --}}
<section class="main-section">
    <div class="container">
        <div class="main-section__header">
            <h3 class="section-head">{{ __('general.sponsors_main_heading') }}</h3>
        </div>
        <div class="main-section__wrapper">
            <div class="row g-2">
                @forelse($sponsors as $sponsor)
                    @php
                        $logoUrl = $sponsor->getFirstMediaUrl('logo') ?: asset('images/statec.webp');
                        $name = $sponsor->getTranslation('name', app()->getLocale());
                        $url = $sponsor->website ?: '#';
                    @endphp
                    <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2">
                        <a class="partners__item shadow-sm" href="{{ $url }}" target="_blank" rel="noopener">
                            <img class="img-fluid" src="{{ $logoUrl }}" alt="{{ $name }}">
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center py-5">{{ __('general.no_results') }}</p>
                    </div>
                @endforelse
            </div>
            @if($sponsors->hasPages())
                <div class="pagination mt-4">
                    <p>{{ __('general.page') }} {{ $sponsors->currentPage() }} {{ __('general.of') }} {{ $sponsors->lastPage() }} {{ __('general.pages') }}</p>
                    <ul>
                        <li class="{{ $sponsors->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $sponsors->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>
                        </li>
                        @foreach ($sponsors->getUrlRange(1, $sponsors->lastPage()) as $page => $url)
                            <li class="{{ $page == $sponsors->currentPage() ? 'active' : '' }}">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="{{ $sponsors->hasMorePages() ? '' : 'disabled' }}">
                            <a href="{{ $sponsors->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
{{-- end sponsors --}}
@endsection
