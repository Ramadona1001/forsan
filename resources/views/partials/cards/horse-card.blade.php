<div class="main-card">
    <div class="main-card__img">
        @if($horse->is_featured)
            <div class="product-status">مميز</div>
        @endif

        @if($horse->is_for_sale)
            <div class="product-status" style="left: auto; right: 10px; background: #198754;">للبيع</div>
        @elseif($horse->is_for_rent)
            <div class="product-status" style="left: auto; right: 10px; background: #0dcaf0;">للإيجار</div>
        @endif

        <a href="{{ route('horses.show', $horse) }}">
            <img class="product-img img-fluid"
                src="{{ $horse->getFirstMediaUrl('main_image') ?: 'https://via.placeholder.com/400x300' }}"
                alt="{{ $horse->getTranslation('name', app()->getLocale()) }}">
        </a>

        @include('partials.cards.compare-wishlist-buttons', [
            'type' => 'horse',
            'id' => $horse->id,
            'isInWishlist' => in_array($horse->id, session('wishlist_horses', [])),
            'isInCompare' => in_array($horse->id, session('compare_horses', [])),
        ])
    </div>

    <div class="main-card__content">
        <a class="main-card__name" href="{{ route('horses.show', $horse) }}">
            {{ $horse->getTranslation('name', app()->getLocale()) }}
        </a>

        <p class="main-card__price">
            {{ number_format($horse->price) }} <span>ريال</span>
            @if($horse->is_for_rent && $horse->rent_price_per_day)
                <span class="prev" style="text-decoration: none; color: #777; font-size: 0.9em;">
                    / {{ number_format($horse->rent_price_per_day) }} يومياً
                </span>
            @endif
        </p>

        @if($horse->age)
            <p class="main-card__description">العمر: {{ $horse->age }} عام</p>
        @endif

        @if($horse->breed)
            <p class="main-card__description">النوع: {{ $horse->breed }}</p>
        @endif

        @if($horse->gender)
            <p class="main-card__description">الجنس: {{ $horse->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
        @endif

        <a href="{{ route('horses.show', $horse) }}"
            class="main-button main-primary fill w-100 text-center text-decoration-none">
            عرض التفاصيل
        </a>
    </div>
</div>