@extends('admin.layouts.app')

@section('admin-content')
    <h1 class="h4 mb-3">{{ __('Edit Category') }}</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{ __('Name (Arabic)') }}</label>
            <input type="text" name="name[ar]" class="form-control"
                   value="{{ old('name.ar', $category->getTranslation('name', 'ar')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Name (English)') }}</label>
            <input type="text" name="name[en]" class="form-control"
                   value="{{ old('name.en', $category->getTranslation('name', 'en')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Description (Arabic)') }}</label>
            <textarea name="description[ar]" class="form-control" rows="3">{{ old('description.ar', $category->getTranslation('description', 'ar')) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Description (English)') }}</label>
            <textarea name="description[en]" class="form-control" rows="3">{{ old('description.en', $category->getTranslation('description', 'en')) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Parent Category') }}</label>
            <select name="parent_id" class="form-select">
                <option value="">{{ __('None') }}</option>
                @foreach($parents as $id => $name)
                    <option value="{{ $id }}" @selected(old('parent_id', $category->parent_id) == $id)>
                        {{ is_array($name) ? ($name[app()->getLocale()] ?? reset($name)) : $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Order') }}</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $category->order) }}">
        </div>

        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                   @checked(old('is_active', $category->is_active))>
            <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
@endsection

