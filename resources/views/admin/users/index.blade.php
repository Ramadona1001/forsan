@extends('admin.layouts.app')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">{{ __('Users') }}</h1>
    </div>

    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Phone') }}</th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Active') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ optional($user->type)->label() }}</td>
                <td>
                    @if($user->is_active)
                        <span class="badge bg-success">{{ __('Yes') }}</span>
                    @else
                        <span class="badge bg-secondary">{{ __('No') }}</span>
                    @endif
                </td>
                <td class="text-end">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                        {{ __('Edit') }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('No users found.') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $users->links('pagination::bootstrap-4') }}
@endsection

