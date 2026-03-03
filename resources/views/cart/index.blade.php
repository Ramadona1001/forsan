@extends('layouts.app')

@section('title', 'سلة التسوق - خطى الفرسان')

@section('content')
    <!-- Start preloader-->
    <div class="preloader-parent">
        <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="">
        </div>
    </div>
    <!-- End preloader-->

    <!-- Start shopping-cart-->
    <section class="shopping-cart">
        <div class="container">
            <div class="main-section__header">
                <!-- start breadcrumb-->
                <nav class="breadcrumb-parent" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">عربة التسوق</li>
                    </ol>
                </nav>
                <!-- end breadcrumb-->
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($cart && $cart->items->count() > 0)
                @php
                    $subtotal = $cart->getSubtotal();
                    $taxRate = 0.15;
                    $tax = $subtotal * $taxRate;
                    $delivery = 0; // يمكن تغييره حسب منطق التوصيل
                    $total = $subtotal + $tax + $delivery;
                @endphp
                <div class="row flex-xl-row flex-column-reverse">
                    <div class="col-xl-3">
                        <!-- start main details-->
                        <div class="main-details">
                            <div class="main-details__head">الحساب</div>
                            <div class="main-details__item">
                                <p>الحساب</p>
                                <p>{{ number_format($subtotal) }} ريال</p>
                            </div>
                            <div class="main-details__item">
                                <p>التوصيل</p>
                                <p>{{ number_format($delivery) }} ريال</p>
                            </div>
                            <div class="main-details__item">
                                <p>الضريبه</p>
                                <p>{{ (int)($taxRate * 100) }}%</p>
                            </div>
                            <form action="#" method="post" class="discount-form">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">ادخل كود الخصم</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="discount_code" placeholder="كود الخصم" />
                                        <button type="submit">تطبيق</button>
                                    </div>
                                </div>
                            </form>
                            <div class="main-details__footer">
                                <p>المجموع</p>
                                <p>{{ number_format($total) }} ريال</p>
                            </div>
                            <a class="main-button main-primary outline mt-3 w-100" href="{{ route('products.index') }}">تكمله التسوق</a>
                            @auth
                                <a class="main-button main-primary fill mt-3 w-100" href="{{ route('checkout.index') }}">الدفع</a>
                            @else
                                <a class="main-button main-primary fill mt-3 w-100" href="{{ route('login') }}">سجل دخول لإتمام الشراء</a>
                            @endauth
                        </div>
                        <!-- end main details-->
                    </div>
                    <div class="col-xl-9">
                        <div class="main-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">اسم المنتج</th>
                                            <th scope="col">السعر</th>
                                            <th scope="col">الكمية</th>
                                            <th scope="col">الاجمالى</th>
                                            <th scope="col"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart->items as $index => $item)
                                            <tr>
                                                <td scope="row">
                                                    <div class="item">
                                                        <div class="item__img">
                                                            <img class="img-fluid"
                                                                src="{{ $item->product->getFirstMediaUrl('main_image') ?: asset('images/products/1.webp') }}"
                                                                alt="{{ $item->product->getTranslation('name', app()->getLocale()) }}">
                                                        </div>
                                                        <div class="item__name">
                                                            <a href="{{ route('products.show', $item->product) }}" class="text-decoration-none text-dark">
                                                                {{ $item->product->getTranslation('name', app()->getLocale()) }}
                                                            </a>
                                                            <div class="item__num">رقم {{ $index + 1 }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($item->product->price) }} ريال</td>
                                                <td>
                                                    <form action="{{ route('cart.update') }}" method="POST" class="d-inline cart-quantity-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                        <div class="input-group input-group-sm" style="width: 110px;">
                                                            <button type="button" class="btn btn-outline-secondary quantity-minus">-</button>
                                                            <input type="number" name="quantity"
                                                                class="form-control form-control-sm text-center quantity-input"
                                                                value="{{ $item->quantity }}" min="1" max="99">
                                                            <button type="button" class="btn btn-outline-secondary quantity-plus">+</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>{{ number_format($item->product->price * $item->quantity) }} ريال</td>
                                                <td>
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="main-button main-trash rgb ms-auto" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-bs-title="مسح المنتج من عربة التسوق">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من إفراغ السلة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="main-button main-trash rgb">
                                        <i class="bi bi-trash me-1"></i>إفراغ السلة
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5 empty-cart">
                    <i class="bi bi-cart-x display-1 text-muted"></i>
                    <h3 class="mt-3">عربة التسوق فارغة</h3>
                    <p class="text-muted">لم تقم بإضافة أي منتجات بعد</p>
                    <a href="{{ route('products.index') }}" class="main-button main-primary fill mt-3">
                        <i class="bi bi-bag me-1"></i>تصفح المنتجات
                    </a>
                </div>
            @endif
        </div>
    </section>
    <!-- End shopping-cart-->

    @push('scripts')
    <script>
        document.querySelectorAll('.quantity-plus').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var form = this.closest('form');
                var input = form.querySelector('.quantity-input');
                input.value = Math.min(99, parseInt(input.value) + 1);
                form.submit();
            });
        });
        document.querySelectorAll('.quantity-minus').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var form = this.closest('form');
                var input = form.querySelector('.quantity-input');
                var val = Math.max(1, parseInt(input.value) - 1);
                input.value = val;
                form.submit();
            });
        });
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });
    </script>
    @endpush
@endsection
