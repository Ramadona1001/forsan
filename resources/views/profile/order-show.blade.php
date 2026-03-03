@extends('layouts.app')

@section('title', __('profile.order_details') . ' #' . $order->order_number . ' - ' . config('app.name'))

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
                <!-- Order details content -->
                <div class="main-section__header mb-3">
                    <nav class="breadcrumb-parent" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('profile.orders') }}">طلباتي</a></li>
                            <li class="breadcrumb-item active">تفاصيل الطلب رقم {{ $order->order_number }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="row flex-xl-row flex-column-reverse">
                    <div class="col-xl-3">
                    <div class="main-details">
                        <div class="main-details__head">الحساب</div>
                        <div class="main-details__item">
                            <p>الحساب</p>
                            <p>{{ number_format($order->subtotal) }} {{ __('profile.currency') }}</p>
                        </div>
                        <div class="main-details__item">
                            <p>التوصيل</p>
                            <p>{{ number_format($order->shipping_cost ?? 0) }} {{ __('profile.currency') }}</p>
                        </div>
                        @if($order->tax > 0)
                        <div class="main-details__item">
                            <p>الضريبه</p>
                            <p>{{ $order->subtotal > 0 ? round(($order->tax / $order->subtotal) * 100) : 0 }}%</p>
                        </div>
                        @endif
                        @if($order->discount > 0)
                        <div class="main-details__item">
                            <p>الخصم</p>
                            <p>-{{ number_format($order->discount) }} {{ __('profile.currency') }}</p>
                        </div>
                        @endif
                        <div class="main-details__footer">
                            <p>المجموع</p>
                            <p>{{ number_format($order->total) }} {{ __('profile.currency') }}</p>
                        </div>
                    </div>
                    </div>

                <div class="col-xl-9">
                    <div class="main-table mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">{{ __('profile.order_info') }}</h5>
                            <span class="badge bg-{{ $order->status->color() }}">{{ $order->status->label() }}</span>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>{{ __('profile.order_date') }}:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                                <p class="mb-1"><strong>{{ __('profile.payment_method') }}:</strong>
                                    @switch($order->payment_method)
                                        @case('cod') {{ __('profile.payment_method_cod') }} @break
                                        @case('card') {{ __('profile.payment_method_card') }} @break
                                        @case('wallet') {{ __('profile.payment_method_wallet') }} @break
                                        @default {{ $order->payment_method }}
                                    @endswitch
                                </p>
                                <p class="mb-0"><strong>{{ __('profile.payment_status') }}:</strong> <span class="badge bg-{{ $order->payment_status->color() }}">{{ $order->payment_status->label() }}</span></p>
                            </div>
                            @if($order->shipping_address && count($order->shipping_address) > 0)
                            <div class="col-md-6">
                                <h6>{{ __('profile.shipping_address') }}</h6>
                                <p class="section-text mb-0">
                                    @if(isset($order->shipping_address['street']))
                                        {{ $order->shipping_address['street'] ?? '' }}{{ isset($order->shipping_address['city']) ? ' - ' . $order->shipping_address['city'] : '' }}{{ isset($order->shipping_address['country']) ? ' - ' . $order->shipping_address['country'] : '' }}
                                    @else
                                        {{ implode(' - ', array_filter($order->shipping_address)) }}
                                    @endif
                                </p>
                            </div>
                            @endif
                        </div>

                        <h6 class="mb-3">{{ __('profile.products') }}</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('profile.product') }}</th>
                                        <th scope="col">{{ __('profile.price') }}</th>
                                        <th scope="col">{{ __('profile.quantity') }}</th>
                                        <th scope="col">{{ __('profile.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $index => $item)
                                    <tr>
                                        <td scope="row">
                                            <div class="item">
                                                <div class="item__img">
                                                    <img class="img-fluid" src="{{ $item->product->getFirstMediaUrl('main_image') ?: asset('images/products/1.webp') }}" alt="">
                                                </div>
                                                <div class="item__name">
                                                    {{ $item->product->getTranslation('name', app()->getLocale()) }}
                                                    <div class="item__num">رقم {{ $index + 1 }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->price) }} {{ __('profile.currency') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->total) }} {{ __('profile.currency') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($order->notes)
                    <div class="mb-3">
                        <h6>{{ __('profile.notes') }}</h6>
                        <p class="section-text text-muted">{{ $order->notes }}</p>
                    </div>
                    @endif

                    <div class="section-buttons mt-3">
                        <a href="{{ route('profile.orders') }}" class="main-button main-primary outline">
                            <i class="bi bi-arrow-right me-1"></i>{{ __('profile.back_to_orders') }}
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
