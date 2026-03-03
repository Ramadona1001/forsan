@extends('layouts.app')

@section('title', __('profile.my_horses_title'))

@section('content')
    <section class="profile">
        <div class="container">
            <div class="profile__header">
                <button class="navbar-toggler shadow-none main-button main-primary fill" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#navbarUser">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="offcanvas-xl offcanvas-start" id="navbarUser">
                        <div class="offcanvas-header">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img class="img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                            </a>
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#navbarUser"></button>
                        </div>
                        <div class="offcanvas-body">
                            @include('profile.partials.sidebar')
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="main-section">
                        <div class="main-section__header d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                            <h3 class="section-head line mb-0"><i class="bi bi-heart me-2"></i>{{ __('profile.my_horses') }}</h3>
                            <a href="{{ route('profile.horses.create') }}" class="main-button main-primary fill">
                                <i class="bi bi-plus me-1"></i>{{ __('profile.add_horse') }}
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($horses->count() > 0)
                            <div class="row g-4">
                                @foreach($horses as $horse)
                                    <div class="col-xxl-4 col-xl-6 col-lg-4 col-6">
                                        <div class="main-card h-100">
                                            <div class="main-card__img">
                                                @if($horse->is_for_sale)
                                                    <div class="product-status">{{ __('profile.for_sale') }}</div>
                                                @elseif($horse->is_for_rent)
                                                    <div class="product-status" style="left: auto; right: 10px; background: #0dcaf0;">{{ __('profile.for_rent') }}</div>
                                                @endif
                                                <a href="{{ route('horses.show', $horse) }}">
                                                    <img class="product-img img-fluid" src="{{ $horse->getFirstMediaUrl('main_image') ?: 'https://via.placeholder.com/400x300' }}" alt="{{ $horse->getTranslation('name', app()->getLocale()) }}" style="object-fit: cover;">
                                                </a>
                                            </div>
                                            <div class="main-card__content">
                                                <a class="main-card__name" href="{{ route('horses.show', $horse) }}">{{ $horse->getTranslation('name', app()->getLocale()) }}</a>
                                                <p class="main-card__price">{{ number_format($horse->price ?? 0) }} <span>{{ __('profile.currency') }}</span></p>
                                                @if($horse->breed || $horse->gender)
                                                    <p class="main-card__description">{{ $horse->breed }}{{ $horse->breed && $horse->gender ? ' • ' : '' }}{{ $horse->gender ? ($horse->gender == 'male' ? __('profile.male') : __('profile.female')) : '' }}</p>
                                                @endif
                                                <div class="section-buttons mt-2">
                                                    <form action="{{ route('profile.horses.delete', $horse) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('profile.delete_confirm_horse') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="main-button main-primary fill">{{ __('profile.delete') }}</button>
                                                    </form>
                                                    <a href="{{ route('profile.horses.edit', $horse) }}" class="main-button main-primary outline">{{ __('profile.edit') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">{{ $horses->links() }}</div>
                        @else
                            <div class="profile__empty text-center py-5 mb-3">
                                <img class="img-fluid mb-3" src="{{ asset('images/icons/horses-profile.svg') }}" alt="" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                <i class="bi bi-heart display-1 text-muted mb-3" style="display: none;"></i>
                                <h3 class="mb-3">{{ __('profile.no_horses') }}</h3>
                            </div>
                            <a href="{{ route('profile.horses.create') }}" class="main-button main-primary fill w-100">{{ __('profile.add_first_horse') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
