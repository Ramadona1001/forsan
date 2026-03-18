@extends('admin.layouts.app')

@section('admin-content')
    <h1 class="h4 mb-3">{{ __('Create Service') }}</h1>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('Title (Arabic)') }}</label>
            <input type="text" name="title[ar]" class="form-control" value="{{ old('title.ar') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Title (English)') }}</label>
            <input type="text" name="title[en]" class="form-control" value="{{ old('title.en') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Description (Arabic)') }}</label>
            <textarea name="description[ar]" class="form-control" rows="4">{{ old('description.ar') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Description (English)') }}</label>
            <textarea name="description[en]" class="form-control" rows="4">{{ old('description.en') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Category') }}</label>
            <select name="category_id" class="form-select">
                <option value="">{{ __('Select category') }}</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" @selected(old('category_id') == $id)>
                        {{ is_array($name) ? ($name[app()->getLocale()] ?? reset($name)) : $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', 0) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Status') }}</label>
            <select name="status" class="form-select">
                <option value="active" @selected(old('status') === 'active')>{{ __('Active') }}</option>
                <option value="inactive" @selected(old('status') === 'inactive')>{{ __('Inactive') }}</option>
                <option value="draft" @selected(old('status') === 'draft')>{{ __('Draft') }}</option>
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="hidden" name="is_featured" value="0">
            <input type="checkbox" name="is_featured" value="1" class="form-check-input"
                   id="is_featured" @checked(old('is_featured'))>
            <label class="form-check-label" for="is_featured">{{ __('Featured') }}</label>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Image') }}</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </form>
@endsection

