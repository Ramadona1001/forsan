@php
    $serviceTitle = $service->getTranslation('title', app()->getLocale()) ?? $service->getTranslation('name', app()->getLocale()) ?? '';
    $serviceUrl = $service->category?->slug
        ? (Route::has('services.show') ? route('services.show', $service->category->slug) : '#')
        : (($service instanceof \App\Models\HorseReview)
            ? route('services.horse-reviews.show', $service->slug)
            : (($service instanceof \App\Models\Photography)
                ? route('services.photography.show', $service->slug)
                : '#'));
    $serviceType = 'service';
@endphp
<div class="main-card">
    <div class="main-card__img">
        @if(isset($service->is_featured) && $service->is_featured)
            <div class="product-status">{{ __('general.blog_is_featured') }}</div>
        @endif

        @if($service->category ?? null)
            <div class="product-status" style="left: auto; right: 10px; background: var(--bs-primary, #0d6efd);">
                {{ $service->category->getTranslation('name', app()->getLocale()) }}
            </div>
        @endif

        <a href="{{ $serviceUrl }}">
            <img class="product-img img-fluid"
                src="{{ $service->getFirstMediaUrl('image') ?: 'https://via.placeholder.com/400x300' }}"
                alt="{{ $serviceTitle }}">
        </a>

        @include('partials.cards.compare-wishlist-buttons', [
            'type' => $serviceType,
            'id' => $service->id,
            'isInWishlist' => in_array($service->id, session('wishlist_services', [])),
            'isInCompare' => in_array($service->id, session('compare_services', [])),
        ])
    </div>

    <div class="main-card__content">
        <a class="main-card__name" href="{{ $serviceUrl }}">{{ $serviceTitle }}</a>

        @if(isset($service->price) && $service->price !== null)
            <p class="main-card__price">{{ number_format($service->price) }} <span>{{ __('home.sar') }}</span></p>
        @endif

        @if($service->provider ?? null)
            <p class="main-card__description">
                <i class="bi bi-building me-1"></i>{{ $service->provider->name ?? $service->provider->user?->name ?? '' }}
            </p>
        @endif

        <a href="{{ $serviceUrl }}" class="main-button main-primary fill w-100 text-center text-decoration-none">
            <i class="bi bi-calendar-check me-1"></i>{{ __('services.book_now') }}
        </a>
    </div>
</div>
