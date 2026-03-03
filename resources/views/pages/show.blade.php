@extends('layouts.app')

@section('title', $page->getTranslation('title', app()->getLocale()) . ' - خطى الفرسان')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">{{ $page->getTranslation('title', app()->getLocale()) }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <h1 class="mb-4">{{ $page->getTranslation('title', app()->getLocale()) }}</h1>

                        <div class="page-content">
                            {!! $page->getTranslation('content', app()->getLocale()) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection