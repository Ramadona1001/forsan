<div class="main-card">
    <div class="main-card__img">
        <a href="{{ route('stables.show', $stable) }}">
            <img class="product-img img-fluid"
                src="{{ $stable->getFirstMediaUrl('cover') ?: asset('images/stores/1.webp') }}"
                alt="{{ $stable->getTranslation('name', app()->getLocale()) }}">
        </a>
        @if($stable->is_verified)
            <div class="product-status" style="left: 10px; right: auto; background: #198754;">موثق</div>
        @endif
        @if($stable->is_featured)
            <div class="product-status">مميز</div>
        @endif
    </div>
    <div class="main-card__content">
        <a class="main-card__name" href="{{ route('stables.show', $stable) }}">
            {{ $stable->getTranslation('name', app()->getLocale()) }}
        </a>
        @if($stable->rating)
            <p class="main-card__price">{{ number_format($stable->rating, 1) }} <span>تقييم</span></p>
        @endif
        @if($stable->city || $stable->country)
            <p class="main-card__description">
                <i class="bi bi-geo-alt me-1"></i>{{ trim(($stable->city ?? '') . ($stable->city && $stable->country ? ' - ' : '') . ($stable->country ?? '')) }}
            </p>
        @endif
        @if($stable->description)
            <p class="main-card__description">{{ Str::limit(strip_tags($stable->getTranslation('description', app()->getLocale())), 80) }}</p>
        @endif
        <a href="{{ route('stables.show', $stable) }}" class="main-button main-primary fill">المزيد</a>
    </div>
</div>
