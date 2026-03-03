@extends('layouts.app')

@section('title', 'الخيول - خطى الفرسان')

@section('content')
    <!-- start main-banner-->
    <section class="pb-0" style="margin-top: 100px;">
        <div class="container">
            <div class="main-banner">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="main-banner__head">عروض خاصه علي الخيل العربي</h3>
                        <p class="main-banner__sale">تصل ال 20%</p>
                        <!-- start breadcrumb-->
                        <nav class="breadcrumb-parent" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item active">خدمة بيع الخيل</li>
                            </ol>
                        </nav>
                        <!-- end breadcrumb-->
                    </div>
                    <div class="col-md-4 d-none d-md-block text-center">
                        <img class="img-fluid" src="{{ asset('assets/images/icons/horse.svg') }}" alt="" title="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end main-banner-->

    <!-- start products-->
    <section class="main-section products">
        <div class="container">
            <div class="row">
                <div class="col-xxl-3">
                    <div class="products__filters">
                        <div class="offcanvas-xxl offcanvas-start" id="productsFilters">
                            <div class="offcanvas-header">
                                <h3>المرشحات</h3>
                                <button class="btn-close" type="button" data-bs-dismiss="offcanvas"
                                    data-bs-target="#productsFilters" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form class="main-form" action="{{ route('horses.index') }}" method="GET">
                                    <h5 class="mb-3">نوع العرض</h5>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="filter" id="filter_all" value=""
                                            {{ request('filter') == '' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label class="form-check-label" for="filter_all">الكل</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="filter" id="filter_sale"
                                            value="for_sale" {{ request('filter') == 'for_sale' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="filter_sale">للبيع</label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="filter" id="filter_rent"
                                            value="for_rent" {{ request('filter') == 'for_rent' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="filter_rent">للإيجار</label>
                                    </div>

                                    <h5 class="mb-3">السلالة</h5>
                                    <select name="breed" class="form-select mb-4" onchange="this.form.submit()">
                                        <option value="">الكل</option>
                                        @foreach($breeds as $breed)
                                            <option value="{{ $breed }}" {{ request('breed') == $breed ? 'selected' : '' }}>
                                                {{ $breed }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <h5 class="mb-3">الجنس</h5>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_all" value=""
                                            {{ request('gender') == '' ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label class="form-check-label" for="gender_all">الكل</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                            value="male" {{ request('gender') == 'male' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="gender_male">ذكر</label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                            value="female" {{ request('gender') == 'female' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="gender_female">أنثى</label>
                                    </div>

                                    <h5 class="mb-3">السعر</h5>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <input type="number" name="min_price" class="form-control" placeholder="من"
                                                value="{{ request('min_price') }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" name="max_price" class="form-control" placeholder="إلى"
                                                value="{{ request('max_price') }}">
                                        </div>
                                    </div>

                                    <button type="submit" class="main-button main-primary fill w-100">بحث</button>
                                    <a href="{{ route('horses.index') }}"
                                        class="btn btn-link text-decoration-none w-100 mt-2 text-danger">إعادة تعيين</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9">
                    <div class="d-flex align-items-center justify-content-between gap-3 flex-md-row flex-column mb-4">
                        <h3 class="products__title">جميع الخيول المعروضه ({{ $horses->total() }})</h3>
                        <div class="section-buttons gap-2 d-flex align-items-center">
                            <!-- Sort Dropdown -->
                            <select class="form-select w-auto" onchange="window.location.href=this.value">
                                <option
                                    value="{{ route('horses.index', array_merge(request()->query(), ['sort' => 'latest'])) }}"
                                    {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>الأحدث</option>
                                <option
                                    value="{{ route('horses.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}"
                                    {{ request('sort') == 'price_low' ? 'selected' : '' }}>السعر: من الأقل</option>
                                <option
                                    value="{{ route('horses.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}"
                                    {{ request('sort') == 'price_high' ? 'selected' : '' }}>السعر: من الأعلى</option>
                                <option
                                    value="{{ route('horses.index', array_merge(request()->query(), ['sort' => 'popular'])) }}"
                                    {{ request('sort') == 'popular' ? 'selected' : '' }}>الأكثر مشاهدة</option>
                            </select>

                            <button class="main-button main-primary fill filter-toggler d-xxl-none" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#productsFilters"><i
                                    class="bi bi-funnel"></i></button>
                        </div>
                    </div>

                    @if($horses->count() > 0)
                        <div class="products__wrapper">
                            @foreach($horses as $horse)
                                @include('partials.cards.horse-card', ['horse' => $horse])
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-5">
                            {{ $horses->links() }}
                        </div>
                    @else
                        <div class="dropdown-cart__empty">
                            <i class="bi bi-emoji-frown"></i>
                            <h3>لا توجد خيول مطابقة لبحثك</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- end products-->
@endsection