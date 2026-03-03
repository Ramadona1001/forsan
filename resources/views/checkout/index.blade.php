@extends('layouts.app')

@section('title', 'طريقة الدفع - خطى الفرسان')

@section('content')
    <!-- Start preloader-->
    <div class="preloader-parent">
        <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="">
        </div>
    </div>
    <!-- End preloader-->

    <!-- Start checkout-->
    <section class="checkout">
        <div class="container">
            <div class="main-section__header">
                <!-- start breadcrumb-->
                <nav class="breadcrumb-parent" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">عربه التسوق</a></li>
                        <li class="breadcrumb-item active">طريقه الدفع</li>
                    </ol>
                </nav>
                <!-- end breadcrumb-->
            </div>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @php
                $subtotal = $cart->getSubtotal();
                $taxRate = 0.15;
                $tax = $subtotal * $taxRate;
                $delivery = 0;
                $total = $subtotal + $tax + $delivery;
                $user = auth()->user();
            @endphp

            <div class="row">
                <div class="col-xl-3">
                    <!-- start main details-->
                    <div class="main-details">
                        <div class="main-details__head">كود الطلب</div>
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
                        <div class="main-details__footer">
                            <p>المجموع</p>
                            <p>{{ number_format($total) }} ريال</p>
                        </div>
                    </div>
                    <!-- end main details-->
                </div>
                <div class="col-xl-9">
                    <form class="main-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <!-- user info -->
                        <div class="checkout__item mb-4">
                            <h3>معلومات عن العميل</h3>
                            <div class="checkout__item__content">
                                <div class="user-info">
                                    <div class="user-info__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <p>{{ $user->name }}</p>
                                    </div>
                                    <div class="user-info__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M2 8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5H7" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M2 16.5H8" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M2 12.5H5" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    @if($user->phone)
                                        <div class="user-info__item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"></path>
                                                <path d="M18.5 9C18.5 8.4 18.03 7.48 17.33 6.73C16.69 6.04 15.84 5.5 15 5.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M22 9C22 5.13 18.87 2 15 2" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <p>{{ $user->phone }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- payment methods-->
                        <div class="checkout__item">
                            <h3>اختر طريقه الدفع</h3>
                            <div class="checkout__item__content">
                                <div class="payment-methods">
                                    <!-- credit card -->
                                    <div class="payment-methods__item">
                                        <div class="form-check">
                                            <input class="form-check-input" id="creditCard" type="radio" name="payment_method" value="card">
                                            <label class="form-check-label" for="creditCard">بطاقة إئتمان</label>
                                        </div>
                                    </div>
                                    <!-- wallet -->
                                    <div class="payment-methods__item">
                                        <div class="form-check">
                                            <input class="form-check-input" id="case" type="radio" name="payment_method" value="wallet">
                                            <label class="form-check-label" for="case">محفظه</label>
                                        </div>
                                        <div class="payment-methods__item__content">
                                            <div class="case">
                                                <p class="text-center">الرصيد المتاح : 00.00 ريال</p>
                                                <a class="main-button main-primary fill w-100" href="{{ route('profile.wallet') }}" type="button">شحن المحفظه</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cash on delivery-->
                                    <div class="payment-methods__item">
                                        <div class="form-check">
                                            <input class="form-check-input" id="cashOnDelivery" type="radio" name="payment_method" value="cod" checked>
                                            <label class="form-check-label" for="cashOnDelivery">الدفع عند الاستلام</label>
                                        </div>
                                        <div class="payment-methods__item__content">
                                            <p class="text-center">يرجا العلم انه عند الدفع عند الاستلام يتم إضافه رسوم إضافيه</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="installment mt-3">
                                    <h3>يمكنك ايضا التقسيط عبر</h3>
                                    <div class="installment__items">
                                        <label class="installment__item">
                                            <input type="radio" name="installment_method" value="tabby" hidden><img class="img-fluid" src="{{ asset('images/icons/tabby.webp') }}" alt="tabby" title="tabby" onerror="this.style.display='none'">
                                        </label>
                                        <label class="installment__item">
                                            <input type="radio" name="installment_method" value="tmara" hidden><img class="img-fluid" src="{{ asset('images/icons/tmara.webp') }}" alt="tmara" title="tmara" onerror="this.style.display='none'">
                                        </label>
                                        <label class="installment__item">
                                            <input type="radio" name="installment_method" value="sadad" hidden><img class="img-fluid" src="{{ asset('images/icons/sadad.webp') }}" alt="sadad" title="sadad" onerror="this.style.display='none'">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="divider">

                        <!-- Discount code-->
                        <div class="checkout__item">
                            <h3>كود الخصم</h3>
                            <div class="checkout__item__content">
                                <div class="discount-code">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="discount_code" placeholder="برجاء ادخال الكود">
                                        <button type="button">تطبيق</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="divider">

                        <!-- address-->
                        <div class="checkout__item">
                            <h3>العنوان</h3>
                            <div class="checkout__item__content">
                                <div class="addresses">
                                    @if($addresses->count() > 0)
                                        @foreach($addresses as $address)
                                            <div>
                                                <div class="addresses__item">
                                                    <div class="addresses__item__address">
                                                        <p class="section-text">{{ $address->getFullAddress() }}</p>
                                                        <div class="section-buttons">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="radio" name="address_id" id="address_{{ $address->id }}" value="{{ $address->id }}" {{ $loop->first ? 'checked' : '' }}>
                                                            </div>
                                                            <a href="{{ route('profile.addresses') }}" class="btn btn-link p-0" type="button" title="تعديل">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M16.04 3.02001L8.16 10.9C7.86 11.2 7.56 11.79 7.5 12.22L7.07 15.23C6.91 16.32 7.68 17.08 8.77 16.93L11.78 16.5C12.2 16.44 12.79 16.14 13.1 15.84L20.98 7.96001C22.34 6.60001 22.98 5.02001 20.98 3.02001C18.98 1.02001 17.4 1.66001 16.04 3.02001Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M14.91 4.1499C15.58 6.5399 17.45 8.4099 19.85 9.0899" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <a class="main-button main-primary outline" href="{{ route('profile.addresses') }}">إضافه عنوان جديد</a>
                                    @else
                                        <div class="alert alert-warning mb-3">
                                            لا يوجد عناوين محفوظة. يرجى إضافة عنوان للمتابعة.
                                        </div>
                                        <a class="main-button main-primary fill" href="{{ route('profile.addresses') }}">إضافه عنوان جديد</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms_conditions" value="1">
                            <label class="form-check-label" for="terms-conditions"> الموافقه علي جميع <a href="{{ url('/terms') }}" target="_blank">الشروط و الاحكام </a></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="privacy-policy" name="privacy_policy" value="1">
                            <label class="form-check-label" for="privacy-policy"> الموافقه الشروط والاحكام الخاصة <a href="{{ url('/privacy') }}" target="_blank">بالاسترجاع و الاستبدال </a></label>
                        </div>

                        <input type="hidden" name="notes" value="{{ old('notes') }}">

                        @if($addresses->count() > 0)
                            <button class="main-button main-primary fill mt-3" type="submit">دفع</button>
                        @else
                            <a class="main-button main-primary fill mt-3 d-inline-block" href="{{ route('profile.addresses') }}">أضف عنوان أولاً</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End checkout-->
@endsection
