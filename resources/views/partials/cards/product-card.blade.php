<div class="main-card">
    <div class="main-card__img">
        {{-- Discount Badge --}}
        @if($product->isOnSale())
            <div class="product-status">{{ $product->getDiscountPercentage() }} %</div>
        @endif

        {{-- Out of Stock Badge --}}
        @if(!$product->isInStock())
            <div class="product-status unavailable">{{ __('home.unavailable', ['days' => 4]) }}</div> {{-- Defaulting to 4
            days or should be dynamic if backend supports it. Using generic unavailable for now if no date --}}
        @endif

        <a href="{{ route('products.show', $product) }}">
            <img class="product-img img-fluid"
                src="{{ $product->getFirstMediaUrl('main_image') ?: asset('images/products/1.webp') }}"
                alt="{{ $product->getTranslation('name', app()->getLocale()) }}">
        </a>

        @include('partials.cards.compare-wishlist-buttons', [
            'type' => 'product',
            'id' => $product->id,
            'isInWishlist' => in_array($product->id, session('wishlist_products', [])),
            'isInCompare' => in_array($product->id, session('compare_products', [])),
        ])
    </div>
    <div class="main-card__content">
        <a class="main-card__name"
            href="{{ route('products.show', $product) }}">{{ $product->getTranslation('name', app()->getLocale()) }}</a>
        <p class="main-card__price">{{ number_format($product->price, 2) }} <span>{{ __('home.sar') }}</span>
            @if($product->compare_price && $product->compare_price > $product->price)
                <span class="prev">{{ number_format($product->compare_price, 2) }} <span>{{ __('home.sar') }}</span></span>
            @endif
        </p>
        <p class="main-card__description">
            {{ Str::limit(strip_tags($product->getTranslation('description', app()->getLocale()) ?? ''), 150) }}
        </p>

        @if(!$product->isOutOfStock())
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="main-button main-primary fill">{{ __('home.add_to_cart') }}</button>
            </form>
        @else
            <button class="main-button main-primary fill disabled">{{ __('home.unavailable', ['days' => '']) }}</button>
        @endif
    </div>
</div>