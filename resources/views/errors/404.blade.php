@extends('layouts.app')

@section('title', 'الصفحة غير موجودة - خطى الفرسان')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="error-page py-5">
                    <h1 class="display-1 fw-bold text-primary">404</h1>
                    <h2 class="mb-3">الصفحة غير موجودة</h2>
                    <p class="text-muted mb-4">عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-house me-1"></i>العودة للرئيسية
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection