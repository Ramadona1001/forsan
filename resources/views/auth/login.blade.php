@extends('layouts.app')

@section('title', 'تسجيل الدخول - خطى الفرسان')

@section('content')
    <!-- start login-->
    <section class="authentication-layout">
        <div class="authentication-layout__wrapper">
            <div class="authentication-layout__logo-wrapper">
                <a class="navbar-brand" href="{{ route('home') }}"><img class="img-fluid" src="{{ asset('images/logo/logo-w.webp') }}" alt="logo" title="logo"></a>
            </div>
            <div class="authentication-layout__form-wrapper">
                <form class="main-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <h3 class="form-head">تسجيل الدخول</h3>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="البريد الالكتروني" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <button class="showPassword" type="button" aria-label="إظهار كلمة المرور"><i class="bi bi-eye"></i> <i class="bi bi-eye-slash d-none"></i></button>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="كلمة المرور" required>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                            <label class="form-check-label" for="remember">تذكرنى</label>
                        </div>
                        <div class="form-group mb-0"><a href="{{ route('password.request') }}">هل نسيت كلمة المرور؟</a></div>
                    </div>
                    <button class="main-button main-primary fill" type="submit">تسجيل</button>
                    <p class="section-text mt-4">ليس لديك حساب ؟ <a href="{{ route('register') }}">انشاء حساب</a></p>
                </form>
            </div>
        </div>
    </section>
    <!-- end login-->

    @push('scripts')
    <script>
        document.querySelectorAll('.showPassword').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = this.closest('.input-wrapper').querySelector('input[type="password"], input[type="text"]');
                var eye = this.querySelector('.bi-eye');
                var slash = this.querySelector('.bi-eye-slash');
                if (input.type === 'password') {
                    input.type = 'text';
                    eye.classList.add('d-none');
                    slash.classList.remove('d-none');
                } else {
                    input.type = 'password';
                    eye.classList.remove('d-none');
                    slash.classList.add('d-none');
                }
            });
        });
    </script>
    @endpush
@endsection
