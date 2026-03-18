@extends('admin.layouts.app')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">{{ __('Services') }}</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">{{ __('Create Service') }}</a>
    </div>

    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Category') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Provider') }}</th>
            <th>{{ __('Status') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->getTranslation('title', app()->getLocale()) }}</td>
                <td>{{ $service->category?->getTranslation('name', app()->getLocale()) }}</td>
                <td>{{ number_format($service->price, 2) }}</td>
                <td>{{ $service->provider?->name }}</td>
                <td>{{ $service->status }}</td>
                <td class="text-end">
                    <a href="{{ route('admin.services.show', $service) }}" class="btn btn-sm btn-outline-secondary">
                        {{ __('Show') }}
                    </a>
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary">
                        {{ __('Edit') }}
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('{{ __('Are you sure?') }}')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" type="submit">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('No services found.') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $services->links('pagination::bootstrap-4') }}
@endsection

