@extends('layouts.app')

@section('title', __('profile.my_wishlist') . ' - ' . config('app.name'))


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-4">
                @include('profile.partials.sidebar')
            </div>

            <div class="col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-star me-2"></i>{{ __('profile.my_wishlist') }}</h5>

                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($wishlist->count() > 0)
                            <div class="row">
                                @foreach($wishlist as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            @if($item->wishlistable)
                                                <img src="{{ $item->wishlistable->getFirstMediaUrl('main_image') ?: 'https://via.placeholder.com/300' }}"
                                                    class="card-img-top" style="height: 150px; object-fit: cover;" alt="">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        {{ $item->wishlistable->getTranslation('name', app()->getLocale()) ?? $item->wishlistable->name }}
                                                    </h6>
                                                    <p class="text-muted small mb-2">
                                                        @if($item->wishlistable_type == 'App\Models\Horse')
                                                            <span class="badge bg-info">{{ __('profile.horse_type') }}</span>

                                                        @elseif($item->wishlistable_type == 'App\Models\Product')
                                                            <span class="badge bg-success">{{ __('profile.product_type') }}</span>

                                                        @elseif($item->wishlistable_type == 'App\Models\Service')
                                                            <span class="badge bg-warning">{{ __('profile.service_type') }}</span>

                                                        @endif
                                                    </p>
                                                    @if(isset($item->wishlistable->price))
                                                        <p class="text-primary fw-bold mb-0">{{ number_format($item->wishlistable->price) }}
                                                            {{ __('profile.currency') }}</p>

                                                    @endif
                                                </div>
                                                <div class="card-footer bg-white">
                                                    <div class="d-flex justify-content-between">
                                                        @if($item->wishlistable_type == 'App\Models\Horse')
                                                            <a href="{{ route('horses.show', $item->wishlistable_id) }}"
                                                                class="btn btn-sm btn-outline-primary">{{ __('profile.show') }}</a>

                                                        @elseif($item->wishlistable_type == 'App\Models\Product')
                                                            <a href="{{ route('products.show', $item->wishlistable_id) }}"
                                                                class="btn btn-sm btn-outline-primary">{{ __('profile.show') }}</a>

                                                        @elseif($item->wishlistable_type == 'App\Models\Service')
                                                            <a href="{{ route('services.show', $item->wishlistable_id) }}"
                                                                class="btn btn-sm btn-outline-primary">{{ __('profile.show') }}</a>

                                                        @endif
                                                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-star display-1 text-muted"></i>
                                <h4 class="mt-3">{{ __('profile.wishlist_empty') }}</h4>

                                <p class="text-muted">{{ __('profile.wishlist_empty_desc') }}</p>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection