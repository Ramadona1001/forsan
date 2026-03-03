@extends('layouts.app')

@section('title', 'تم الطلب بنجاح - خطى الفرسان')

@section('content')
    <!-- Start preloader-->
    <div class="preloader-parent">
        <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt=""></div>
    </div>
    <!-- End preloader-->

    <section class="checkout-success">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-card">
                        <div class="order-success-card__body">
                            {{-- Success icon in white circle --}}
                            <div class="order-success-card__icon-wrap">
                                <i class="bi bi-check-circle-fill order-success-card__icon"></i>
                            </div>

                            <h1 class="order-success-card__title">تم الطلب بنجاح!</h1>
                            <p class="order-success-card__subtitle">شكراً لك، تم استلام طلبك وسيتم التواصل معك قريباً</p>

                            <div class="order-success-card__details">
                                <h5 class="order-success-card__details-head">تفاصيل الطلب</h5>
                                <p class="order-success-card__detail-row"><strong>رقم الطلب:</strong> {{ $order->order_number }}</p>
                                <p class="order-success-card__detail-row"><strong>الإجمالي:</strong> {{ number_format($order->total) }} ر.س</p>
                                <p class="order-success-card__detail-row mb-0"><strong>طريقة الدفع:</strong>
                                    @switch($order->payment_method)
                                        @case('cod') الدفع عند الاستلام @break
                                        @case('card') بطاقة ائتمان @break
                                        @case('wallet') المحفظة @break
                                        @default {{ $order->payment_method }}
                                    @endswitch
                                </p>
                            </div>

                            <div class="order-success-card__products">
                                <h6 class="order-success-card__products-head">المنتجات</h6>
                                @foreach($order->items as $item)
                                    <div class="order-success-card__product-row">
                                        <span>{{ $item->product->getTranslation('name', app()->getLocale()) }} × {{ $item->quantity }}</span>
                                        <span>{{ number_format($item->total) }} ر.س</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-success-card__actions">
                                <a href="{{ route('profile.orders.show', $order) }}" class="main-button main-primary fill">
                                    <i class="bi bi-eye me-1"></i>عرض الطلب
                                </a>
                                <a href="{{ route('products.index') }}" class="main-button main-primary outline">
                                    <i class="bi bi-bag me-1"></i>متابعة التسوق
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        .checkout-success {
            background: #ffffff;
        }
        .order-success-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .order-success-card__body {
            padding: 2.5rem 2rem;
            text-align: center;
        }
        /* Success icon - green in white circle */
        .order-success-card__icon-wrap {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: #ffffff;
            border: 3px solid #22c55e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.25);
        }
        .order-success-card__icon {
            font-size: 2.5rem;
            color: #22c55e !important;
        }
        /* Success title - green */
        .order-success-card__title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #22c55e !important;
            margin-bottom: 0.75rem;
        }
        /* Subtitle - medium grey */
        .order-success-card__subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 1.5rem;
        }
        /* Order details card - light grey background */
        .order-success-card__details {
            background: #f5f5f5;
            border-radius: 8px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            text-align: right;
        }
        .order-success-card__details-head,
        .order-success-card__products-head {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.75rem;
        }
        .order-success-card__detail-row {
            color: #374151;
            margin-bottom: 0.35rem;
        }
        .order-success-card__products {
            margin-bottom: 1.5rem;
            text-align: right;
        }
        .order-success-card__product-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
        }
        .order-success-card__product-row:last-child {
            border-bottom: none;
        }
        .order-success-card__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
        }
    </style>
    @endpush
@endsection
