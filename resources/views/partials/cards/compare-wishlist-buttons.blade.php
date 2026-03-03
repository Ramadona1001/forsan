{{--
    أيقونات المقارنة والمفضلة موحدة في كل الموقع.
    الاستخدام: @include('partials.cards.compare-wishlist-buttons', ['type' => 'product', 'id' => $product->id, 'isInWishlist' => $isInWishlist, 'isInCompare' => $isInCompare])
    أو للمتاجر (عرض فقط): @include('partials.cards.compare-wishlist-buttons', ['disabled' => true])
--}}
@php
    $disabled = $disabled ?? false;
    $isInWishlist = $isInWishlist ?? false;
    $isInCompare = $isInCompare ?? false;
@endphp
<div class="product-controls card-actions">
    @if($disabled)
        <button type="button" class="add-favorites" disabled aria-hidden="true" tabindex="-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12.62 20.8101C12.28 20.9301 11.72 20.9301 11.38 20.8101C8.48 19.8201 2 15.6901 2 8.6901C2 5.6001 4.49 3.1001 7.56 3.1001C9.38 3.1001 10.99 3.9801 12 5.3401C13.01 3.9801 14.63 3.1001 16.44 3.1001C19.51 3.1001 22 5.6001 22 8.6901C22 15.6901 15.52 19.8201 12.62 20.8101Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <button type="button" class="add-compare" disabled aria-hidden="true" tabindex="-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 3.11 16.44 3.11 16.44M3.11 16.44H7.63M3.11 16.44V21.44M2 12C2 6.48 6.44 2 12 2C18.67 2 22 7.56 22 7.56M22 7.56V2.56M22 7.56H17.56" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    @else
        <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline ajax-form" data-type="wishlist">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="id" value="{{ $id }}">
            <button type="submit" class="add-favorites {{ $isInWishlist ? 'active' : '' }}" title="المفضلة">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12.62 20.8101C12.28 20.9301 11.72 20.9301 11.38 20.8101C8.48 19.8201 2 15.6901 2 8.6901C2 5.6001 4.49 3.1001 7.56 3.1001C9.38 3.1001 10.99 3.9801 12 5.3401C13.01 3.9801 14.63 3.1001 16.44 3.1001C19.51 3.1001 22 5.6001 22 8.6901C22 15.6901 15.52 19.8201 12.62 20.8101Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </form>
        <form action="{{ route('compare.toggle') }}" method="POST" class="d-inline ajax-form" data-type="compare">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="id" value="{{ $id }}">
            <button type="submit" class="add-compare {{ $isInCompare ? 'active' : '' }}" title="المقارنة">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 3.11 16.44 3.11 16.44M3.11 16.44H7.63M3.11 16.44V21.44M2 12C2 6.48 6.44 2 12 2C18.67 2 22 7.56 22 7.56M22 7.56V2.56M22 7.56H17.56" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </form>
    @endif
</div>
