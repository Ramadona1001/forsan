@extends('layouts.app')

@section('title', 'إنشاء حساب - خطى الفرسان')

@section('content')
    <!-- start sign-up-->
    <section class="authentication-layout">
        <div class="authentication-layout__wrapper">
            <div class="authentication-layout__logo-wrapper">
                <a class="navbar-brand" href="{{ route('home') }}"><img class="img-fluid" src="{{ asset('images/logo/logo-w.webp') }}" alt="logo" title="logo"></a>
            </div>
            <div class="authentication-layout__form-wrapper">
                <form class="main-form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <h3 class="form-head">إنشاء حساب</h3>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="الاسم الكامل" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="البريد الالكتروني" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control @error('phone') is-invalid @enderror" type="tel" name="phone" id="phone" placeholder="رقم الهاتف" value="{{ old('phone') }}">
                            <span class="input-group-text">اختياري</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                            <option value="customer" {{ old('type', 'customer') == 'customer' ? 'selected' : '' }}>مستخدم عادي</option>
                            <option value="horse_owner" {{ old('type') == 'horse_owner' ? 'selected' : '' }}>مالك خيول</option>
                            <option value="stable_owner" {{ old('type') == 'stable_owner' ? 'selected' : '' }}>مالك إسطبل</option>
                            <option value="store_owner" {{ old('type') == 'store_owner' ? 'selected' : '' }}>مالك متجر</option>
                            <option value="trainer" {{ old('type') == 'trainer' ? 'selected' : '' }}>مدرب</option>
                            <option value="veterinarian" {{ old('type') == 'veterinarian' ? 'selected' : '' }}>طبيب بيطري</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <button class="showPassword" type="button" aria-label="إظهار كلمة المرور"><i class="bi bi-eye"></i> <i class="bi bi-eye-slash d-none"></i></button>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="كلمة المرور" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <button class="showPassword" type="button" aria-label="إظهار تأكيد كلمة المرور"><i class="bi bi-eye"></i> <i class="bi bi-eye-slash d-none"></i></button>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="تأكيد كلمة المرور" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" value="1" required>
                            <label class="form-check-label" for="terms">أوافق على <a href="{{ route('pages.show', ['slug' => 'terms']) }}">الشروط والأحكام</a></label>
                        </div>
                    </div>
                    <button class="main-button main-primary fill" type="submit">إنشاء الحساب</button>
                    <p class="section-text mt-4">لديك حساب بالفعل؟ <a href="{{ route('login') }}">سجل دخول</a></p>
                </form>
            </div>
        </div>
    </section>
    <!-- end sign-up-->

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
