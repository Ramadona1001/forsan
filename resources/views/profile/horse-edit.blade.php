@extends('layouts.app')

@section('title', __('profile.edit_horse') . ' - ' . config('app.name'))

@section('content')
    <section class="profile">
        <div class="container">
            <div class="profile__header">
                <button class="navbar-toggler shadow-none main-button main-primary fill" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#navbarUser">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="offcanvas-xl offcanvas-start" id="navbarUser">
                        <div class="offcanvas-header">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img class="img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                            </a>
                            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#navbarUser"></button>
                        </div>
                        <div class="offcanvas-body">
                            @include('profile.partials.sidebar')
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="main-section">
                        <div class="main-section__header mb-4">
                            <h3 class="section-head line"><i class="bi bi-pencil me-2"></i>{{ __('profile.edit_horse') }}</h3>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form class="main-form" action="{{ route('profile.horses.update', $horse) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="horizontal-wrapper">
                                <h3 class="section-header">{{ __('profile.enter_data_below') }}</h3>
                                <div class="main-form custom-form">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">{{ __('profile.horse_name') }} *</label>
                                                <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name', $horse->getTranslation('name', app()->getLocale())) }}" placeholder="{{ __('profile.horse_name') }}" required>
                                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="breed">{{ __('profile.breed') }}</label>
                                                <input class="form-control @error('breed') is-invalid @enderror" id="breed" type="text" name="breed" value="{{ old('breed', $horse->breed) }}" placeholder="{{ __('profile.breed') }}">
                                                @error('breed')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="birth_date">{{ __('profile.birth_date') }}</label>
                                                <input class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" type="date" name="birth_date" value="{{ old('birth_date', $horse->birth_date?->format('Y-m-d')) }}">
                                                @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="color">{{ __('profile.color') }}</label>
                                                <input class="form-control @error('color') is-invalid @enderror" id="color" type="text" name="color" value="{{ old('color', $horse->color) }}" placeholder="{{ __('profile.color') }}">
                                                @error('color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="gender">{{ __('profile.gender') }}</label>
                                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                                    <option value="">{{ __('profile.choose') }}</option>
                                                    <option value="male" {{ old('gender', $horse->gender) == 'male' ? 'selected' : '' }}>{{ __('profile.male') }}</option>
                                                    <option value="female" {{ old('gender', $horse->gender) == 'female' ? 'selected' : '' }}>{{ __('profile.female') }}</option>
                                                </select>
                                                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="description">{{ __('profile.description') }}</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="{{ __('profile.description') }}">{{ old('description', $horse->description) }}</textarea>
                                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="horizontal-wrapper">
                                <h3 class="section-header">{{ __('profile.sale_rent_options') }}</h3>
                                <div class="main-form custom-form">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_for_sale" name="is_for_sale" value="1" {{ old('is_for_sale', $horse->is_for_sale) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_for_sale">{{ __('profile.for_sale') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_for_rent" name="is_for_rent" value="1" {{ old('is_for_rent', $horse->is_for_rent) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_for_rent">{{ __('profile.for_rent') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="price">{{ __('profile.price') }} (ر.س)</label>
                                                <input class="form-control @error('price') is-invalid @enderror" id="price" type="number" name="price" value="{{ old('price', $horse->price) }}" step="0.01" placeholder="{{ __('profile.price') }}">
                                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="horizontal-wrapper">
                                <h3 class="section-header">{{ __('profile.horse_photos') }}</h3>
                                <div class="main-form custom-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="main_image">{{ __('profile.main_image') }}</label>
                                                @if($horse->getFirstMediaUrl('main_image'))
                                                    <div class="mb-2">
                                                        <img src="{{ $horse->getFirstMediaUrl('main_image') }}" alt="" class="img-thumbnail" style="max-height: 120px;">
                                                        <p class="small text-muted mt-1 mb-0">{{ __('profile.current_main_image') }}</p>
                                                    </div>
                                                @endif
                                                <input class="form-control @error('main_image') is-invalid @enderror" id="main_image" type="file" name="main_image" accept="image/*">
                                                <small class="text-muted d-block mt-1">{{ $horse->getFirstMedia('main_image') ? __('profile.replace_main_image') : __('profile.main_image_hint') }}</small>
                                                @error('main_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="gallery">{{ __('profile.gallery_images') }}</label>
                                                @php $galleryMedia = $horse->getMedia('gallery'); @endphp
                                                @if($galleryMedia->count() > 0)
                                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                                        @foreach($galleryMedia as $media)
                                                            <img src="{{ $media->getUrl() }}" alt="" class="img-thumbnail" style="max-height: 80px;">
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <input class="form-control @error('gallery') is-invalid @enderror" id="gallery" type="file" name="gallery[]" accept="image/*" multiple>
                                                <small class="text-muted d-block mt-1">{{ __('profile.gallery_hint') }}</small>
                                                @error('gallery')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                @if($errors->has('gallery.*'))
                                                    <div class="invalid-feedback d-block">{{ $errors->first('gallery.*') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <button type="submit" class="main-button main-primary fill">
                                    <i class="bi bi-check me-1"></i>{{ __('profile.save_changes') }}
                                </button>
                                <a href="{{ route('profile.horses') }}" class="main-button main-primary outline">{{ __('general.cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
