@extends('layouts.app')

@section('title', __('profile.my_wallet') . ' - ' . config('app.name'))


@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-4">
                @include('profile.partials.sidebar')
            </div>

            <div class="col-lg-9">
                <!-- Balance Card -->
                <div class="card shadow-sm mb-4 bg-primary text-white">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-wallet2 display-4"></i>
                        <h2 class="mt-3 mb-1">{{ number_format($wallet?->balance ?? 0) }} {{ __('profile.currency') }}</h2>

                        <p class="mb-0 opacity-75">{{ __('profile.current_balance') }}</p>

                    </div>
                </div>

                <!-- Transactions -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>{{ __('profile.transaction_history') }}
                        </h5>

                    </div>
                    <div class="card-body">
                        @if($wallet && $wallet->transactions->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('profile.type') }}</th>

                                            <th>{{ __('profile.amount') }}</th>

                                            <th>{{ __('profile.description') }}</th>

                                            <th>{{ __('profile.date') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($wallet->transactions as $transaction)
                                            <tr>
                                                <td>
                                                    @if($transaction->type == 'credit')
                                                        <span class="badge bg-success">{{ __('profile.deposit') }}</span>

                                                    @else
                                                        <span class="badge bg-danger">{{ __('profile.withdrawal') }}</span>

                                                    @endif
                                                </td>
                                                <td class="{{ $transaction->type == 'credit' ? 'text-success' : 'text-danger' }}">
                                                    {{ $transaction->type == 'credit' ? '+' : '-' }}{{ number_format($transaction->amount) }}
                                                    {{ __('profile.currency') }}

                                                </td>
                                                <td>{{ $transaction->description }}</td>
                                                <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-clock-history display-1 text-muted"></i>
                                <h4 class="mt-3">{{ __('profile.no_transactions') }}</h4>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection