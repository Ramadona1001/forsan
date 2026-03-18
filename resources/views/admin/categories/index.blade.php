@extends('admin.layouts.app')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">{{ __('Service Categories') }}</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">{{ __('Create Category') }}</a>
    </div>

    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Parent') }}</th>
            <th>{{ __('Order') }}</th>
            <th>{{ __('Active') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->getTranslation('name', app()->getLocale()) }}</td>
                <td>{{ $category->parent?->getTranslation('name', app()->getLocale()) }}</td>
                <td>{{ $category->order }}</td>
                <td>
                    @if($category->is_active)
                        <span class="badge bg-success">{{ __('Yes') }}</span>
                    @else
                        <span class="badge bg-secondary">{{ __('No') }}</span>
                    @endif
                </td>
                <td class="text-end">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                        {{ __('Edit') }}
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline"
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
                <td colspan="6" class="text-center">{{ __('No categories found.') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $categories->links('pagination::bootstrap-4') }}
@endsection

