@extends('layouts.app')

@section('title', __('profile.profile_title') . ' - ' . config('app.name'))


@section('content')
    <section class="profile">
        <div class="container">
            <div class="profile__header">
                <button class="navbar-toggler shadow-none main-button main-primary fill" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#navbarUser">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <div class="row">
                <!-- Sidebar -->
                <div class="col-xl-4">
                    <div class="offcanvas-xl offcanvas-start" id="navbarUser">
                        <div class="offcanvas-header">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img class="img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                            </a>
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas"
                                data-bs-target="#navbarUser"></button>
                        </div>
                        <div class="offcanvas-body">
                            @include('profile.partials.sidebar')
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-xl-8">
                    <div class="profile__content tab-content" id="pills-tabContent">
                        <!-- Edit Profile Tab (Active by default) -->
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                            <form class="main-form" action="{{ route('profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="form-label" for="fName">{{ __('profile.full_name') }}</label>

                                    <input class="form-control @error('name') is-invalid @enderror" id="fName" type="text"
                                        name="name" placeholder="{{ __('profile.enter_full_name') }}"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="email">{{ __('profile.email') }}</label>

                                    <div class="input-group">
                                        <input class="form-control @error('email') is-invalid @enderror" id="email"
                                            type="email" name="email" placeholder="{{ __('profile.enter_email') }}"
                                            value="{{ old('email', $user->email) }}" required>
                                        <span class="input-group-text">{{ __('profile.required') }}</span>

                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="phoneNumber">{{ __('profile.contact_number') }}</label>

                                    <input class="form-control @error('phone') is-invalid @enderror" id="phoneNumber"
                                        type="text" name="phone" placeholder="{{ __('profile.enter_contact_number') }}"
                                        value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="uploadUserPhoto">{{ __('profile.photo') }}</label>

                                    <div class="input-group">
                                        <input class="form-control @error('avatar') is-invalid @enderror"
                                            id="uploadUserPhoto" type="file" name="avatar" accept="image/*">
                                    </div>
                                    @error('avatar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    @if($user->getFirstMediaUrl('avatar'))
                                        <div class="img-preview mt-3">
                                            <div class="item">
                                                <img class="img-fluid rounded" src="{{ $user->getFirstMediaUrl('avatar') }}"
                                                    alt="Current avatar" style="max-width: 150px;">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="bio">{{ __('profile.bio') }}</label>

                                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio"
                                        rows="4" placeholder="{{ __('profile.enter_bio') }}">{{ old('bio', $user->bio) }}</textarea>

                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password">{{ __('profile.new_password') }}</label>

                                    <div class="input-wrapper">
                                        <button class="showPassword" type="button">
                                            <i class="bi bi-eye"></i>
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                                            name="password" id="password"
                                            placeholder="{{ __('profile.leave_blank_password') }}">

                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">{{ __('profile.leave_blank_no_change') }}</small>

                                </div>

                                <div class="formgroup">
                                    <label class="form-label" for="password_confirmation">{{ __('profile.confirm_password') }}</label>

                                    <div class="input-wrapper">
                                        <button class="showPassword" type="button">
                                            <i class="bi bi-eye"></i>
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                        <input class="form-control" type="password" name="password_confirmation"
                                            id="password_confirmation" placeholder="{{ __('profile.reenter_new_password') }}">

                                    </div>
                                </div>

                                <button class="main-button main-primary fill" type="submit">{{ __('profile.update_profile') }}</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.showPassword').forEach(button => {
            button.addEventListener('click', function () {
                const input = this.parentElement.querySelector('input');
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.add('active');
                } else {
                    input.type = 'password';
                    this.classList.remove('active');
                }
            });
        });
    </script>
@endsection