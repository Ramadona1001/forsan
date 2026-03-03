@extends('layouts.app')

@section('title', 'استعادة كلمة المرور - خطى الفرسان')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2>استعادة كلمة المرور</h2>
                            <p class="text-muted">أدخل بريدك الإلكتروني وسنرسل لك رابط استعادة كلمة المرور</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg">
                                <i class="bi bi-envelope me-1"></i>إرسال رابط الاستعادة
                            </button>
                        </form>

                        <hr class="my-4">

                        <p class="text-center mb-0">
                            <a href="{{ route('login') }}" class="text-decoration-none">العودة لتسجيل الدخول</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection