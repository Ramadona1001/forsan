@extends('layouts.app')

@section('title', $knight->getTranslation('name', app()->getLocale()) . ' - خطى الفرسان')

@section('content')
@php
    $locale = app()->getLocale();
    $name = $knight->getTranslation('name', $locale);
    $description = $knight->getTranslation('description', $locale);
    $imageUrl = $knight->getFirstMediaUrl('image') ?: asset('images/knight.webp');
@endphp

<!-- Start preloader -->
<div class="preloader-parent">
    <div class="preloader"><img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt=""></div>
</div>
<!-- End preloader -->

<!-- start main-banner -->
<section class="pb-0">
    <div class="container">
        <div class="main-banner">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3 class="main-banner__head">{{ $name }}</h3>
                    <nav class="breadcrumb-parent" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('about') }}">من نحن</a></li>
                            <li class="breadcrumb-item active">{{ $name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end main-banner -->

<!-- start knight details (نفس هيكل من نحن: صورة + نص) -->
<section class="about-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="about-us__img bordered">
                    <img class="img-fluid w-100" src="{{ $imageUrl }}" alt="{{ $name }}" style="object-fit: cover; max-height: 450px;">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="horizontal-wrapper">
                    <h3 class="section-head">نبذة عن {{ $name }}</h3>
                    @if($description)
                        <div class="section-text">{!! nl2br(e($description)) !!}</div>
                    @else
                        <p class="section-text text-muted">لا يوجد وصف متاح.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
