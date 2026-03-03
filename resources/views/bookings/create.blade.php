@extends('layouts.app')

@section('title', 'حجز ' . $service->getTranslation('name', app()->getLocale()) . ' - خطى الفرسان')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('services.show', $service) }}">{{ $service->getTranslation('title', app()->getLocale()) }}</a>
                </li>
                <li class="breadcrumb-item active">الحجز</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>حجز الخدمة</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('bookings.store', $service) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date" class="form-label">تاريخ الحجز *</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                        name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="start_time" class="form-label">وقت الحجز *</label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                        id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($userHorses->count() > 0)
                                <div class="mb-3">
                                    <label for="horse_id" class="form-label">اختر حصانك (اختياري)</label>
                                    <select class="form-select @error('horse_id') is-invalid @enderror" id="horse_id"
                                        name="horse_id">
                                        <option value="">-- اختر حصان --</option>
                                        @foreach($userHorses as $horse)
                                            <option value="{{ $horse->id }}" {{ old('horse_id') == $horse->id ? 'selected' : '' }}>
                                                {{ $horse->getTranslation('name', app()->getLocale()) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('horse_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="notes" class="form-label">ملاحظات إضافية</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes"
                                    rows="3">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle me-1"></i>تأكيد الحجز
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">ملخص الحجز</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $service->getFirstMediaUrl('image') ?: 'https://via.placeholder.com/80' }}"
                                class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;"
                                alt="{{ $service->name }}">
                            <div>
                                <h6 class="mb-1">{{ $service->getTranslation('name', app()->getLocale()) }}</h6>
                                @if($service->category)
                                    <small
                                        class="text-muted">{{ $service->category->getTranslation('name', app()->getLocale()) }}</small>
                                @endif
                            </div>
                        </div>

                        <hr>

                        @if($service->duration)
                            <div class="d-flex justify-content-between mb-2">
                                <span>المدة:</span>
                                <span>{{ $service->duration }} دقيقة</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <strong>السعر:</strong>
                            <strong class="text-primary">{{ number_format($service->price) }} ر.س</strong>
                        </div>

                        <hr>

                        <div class="features">
                            <p class="mb-2 small"><i class="bi bi-check-circle text-success me-2"></i>تأكيد فوري</p>
                            <p class="mb-2 small"><i class="bi bi-check-circle text-success me-2"></i>إلغاء مجاني</p>
                            <p class="mb-0 small"><i class="bi bi-check-circle text-success me-2"></i>دعم على مدار الساعة
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection