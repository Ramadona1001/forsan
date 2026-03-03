@extends('layouts.app')

@section('title', __('profile.my_orders') . ' - ' . config('app.name'))

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
                <div class="profile__content tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="profile__content__header">
                            <h3><i class="bi bi-bag me-2"></i>{{ __('profile.my_orders') }}</h3>
                        </div>

                        @if($orders->count() > 0)
                            <div class="main-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ __('profile.order_number') }}</th>
                                                <th scope="col">{{ __('profile.date') }}</th>
                                                <th scope="col">{{ __('profile.total') }}</th>
                                                <th scope="col">{{ __('profile.status') }}</th>
                                                <th scope="col">{{ __('profile.payment') }}</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td><strong>{{ $order->order_number }}</strong></td>
                                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                                    <td>{{ number_format($order->total) }} {{ __('profile.currency') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $order->status->color() }}">
                                                            {{ $order->status->label() }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $order->payment_status->color() }}">
                                                            {{ $order->payment_status->label() }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('profile.orders.show', $order) }}" class="main-button main-primary outline btn-sm">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{ $orders->links() }}
                        @else
                            <div class="text-center py-5 empty-orders">
                                <i class="bi bi-bag-x display-1 text-muted"></i>
                                <h4 class="mt-3">{{ __('profile.no_orders') }}</h4>
                                <a href="{{ route('products.index') }}" class="main-button main-primary fill mt-3">
                                    <i class="bi bi-bag me-1"></i>{{ __('profile.shop_now') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
