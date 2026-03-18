@extends('admin.layouts.app')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">{{ $service->getTranslation('title', app()->getLocale()) }}</h1>
        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary">{{ __('Edit') }}</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            @if($service->getFirstMediaUrl('image'))
                <img src="{{ $service->getFirstMediaUrl('image') }}" alt="" class="img-fluid rounded">
            @endif
        </div>
        <div class="col-md-8">
            <dl class="row">
                <dt class="col-sm-3">{{ __('Category') }}</dt>
                <dd class="col-sm-9">{{ $service->category?->getTranslation('name', app()->getLocale()) }}</dd>

                <dt class="col-sm-3">{{ __('Price') }}</dt>
                <dd class="col-sm-9">{{ number_format($service->price, 2) }}</dd>

                <dt class="col-sm-3">{{ __('Provider') }}</dt>
                <dd class="col-sm-9">{{ $service->provider?->name }}</dd>

                <dt class="col-sm-3">{{ __('Status') }}</dt>
                <dd class="col-sm-9">{{ $service->status }}</dd>
            </dl>
        </div>
    </div>

    <div class="mt-4">
        <h2 class="h5">{{ __('Description') }}</h2>
        <p>{!! nl2br(e($service->getTranslation('description', app()->getLocale()))) !!}</p>
    </div>
@endsection

