@extends('admin.layouts.app')

@section('admin-content')
    <h1 class="h4 mb-3">{{ __('Edit Service') }}</h1>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{ __('Title (Arabic)') }}</label>
            <input type="text" name="title[ar]" class="form-control"
                   value="{{ old('title.ar', $service->getTranslation('title', 'ar')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Title (English)') }}</label>
            <input type="text" name="title[en]" class="form-control"
                   value="{{ old('title.en', $service->getTranslation('title', 'en')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Description (Arabic)') }}</label>
            <textarea name="description[ar]" class="form-control" rows="4">{{ old('description.ar', $service->getTranslation('description', 'ar')) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Description (English)') }}</label>
            <textarea name="description[en]" class="form-control" rows="4">{{ old('description.en', $service->getTranslation('description', 'en')) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Category') }}</label>
            <select name="category_id" class="form-select">
                <option value="">{{ __('Select category') }}</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" @selected(old('category_id', $service->category_id) == $id)>
                        {{ is_array($name) ? ($name[app()->getLocale()] ?? reset($name)) : $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control"
                   value="{{ old('price', $service->price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Status') }}</label>
            <select name="status" class="form-select">
                <option value="active" @selected(old('status', $service->status) === 'active')>{{ __('Active') }}</option>
                <option value="inactive" @selected(old('status', $service->status) === 'inactive')>{{ __('Inactive') }}</option>
                <option value="draft" @selected(old('status', $service->status) === 'draft')>{{ __('Draft') }}</option>
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="hidden" name="is_featured" value="0">
            <input type="checkbox" name="is_featured" value="1" class="form-check-input"
                   id="is_featured" @checked(old('is_featured', $service->is_featured))>
            <label class="form-check-label" for="is_featured">{{ __('Featured') }}</label>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">{{ __('Image') }}</label>
            @if($service->getFirstMediaUrl('image'))
                <img src="{{ $service->getFirstMediaUrl('image') }}" alt="" class="img-thumbnail mb-2" style="max-height: 150px;">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </form>
@endsection

