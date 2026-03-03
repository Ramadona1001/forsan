@php
    $locale = app()->getLocale();
    $stableName = $stable->getTranslation('name', $locale);
    $addressLine = trim(implode(' - ', array_filter([$stable->address, $stable->city, $stable->country]))) ?: '—';
@endphp
<div class="horizontal-wrapper">
    <h3 class="section-head">{{ $stableName }}
        @if($stable->rating)
            <span class="price">{{ number_format($stable->rating, 1) }} تقييم</span>
        @endif
    </h3>
    <div class="main-service__item">
        <i class="bi bi-geo-alt"></i>
        <p class="section-text mb-0">{{ $addressLine }}</p>
    </div>
    @if($stable->rating)
        <ul class="main-rate">
            @for($i = 1; $i <= 5; $i++)
                <li><i class="bi bi-star{{ $i <= round($stable->rating) ? '-fill' : '' }}"></i></li>
            @endfor
            <li class="ms-auto"><span class="fw-bold">{{ number_format($stable->rating, 1) }}</span></li>
        </ul>
    @endif
    @if($stable->description)
        <div class="section-text mb-3">{!! nl2br(e($stable->getTranslation('description', $locale))) !!}</div>
    @endif
    @if($stable->working_hours && !empty($stable->working_hours))
        <p class="section-text">مواعيد الإسطبل: @if(is_array($stable->working_hours) && array_keys($stable->working_hours) !== range(0, count($stable->working_hours) - 1))@foreach($stable->working_hours as $whKey => $whVal){{ $whKey }}: {{ $whVal }}@if(!$loop->last) | @endif @endforeach @else {{ is_array($stable->working_hours) ? implode(' - ', $stable->working_hours) : $stable->working_hours }} @endif</p>
    @endif
    @if($stable->stable_type)
        <p class="section-text">نوع الإسطبل: {{ $stable->stable_type }}</p>
    @endif
    <div class="d-flex flex-wrap gap-3 mb-3">
        <span class="section-text"><i class="bi bi-heart me-1"></i><strong>{{ $stable->horses_count }}</strong> حصان</span>
        <span class="section-text"><i class="bi bi-person me-1"></i><strong>{{ $stable->trainers_count }}</strong> مدرب</span>
    </div>

    @auth
        <form class="main-form" action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="bookable_type" value="stable">
            <input type="hidden" name="bookable_id" value="{{ $stable->id }}">
            <label class="form-label">برجاء تحديد ميعاد الحجز</label>
            <div class="form-group">
                <input class="form-control" type="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="start_time_{{ $booking_type ?? 'sessions' }}">وقت البداية</label>
                <input class="form-control" id="start_time_{{ $booking_type ?? 'sessions' }}" type="time" name="start_time" value="{{ old('start_time', '09:00') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="duration_hours_{{ $booking_type ?? 'sessions' }}">عدد الساعات</label>
                <input class="form-control" id="duration_hours_{{ $booking_type ?? 'sessions' }}" type="number" name="duration_hours" value="{{ old('duration_hours', 1) }}" min="1" max="24" placeholder="أدخل عدد الساعات" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="notes_{{ $booking_type ?? 'sessions' }}">ملاحظات (اختياري)</label>
                <textarea class="form-control" id="notes_{{ $booking_type ?? 'sessions' }}" name="notes" rows="2" placeholder="ملاحظات إضافية">{{ old('notes') }}</textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="terms_accepted" id="terms_{{ $booking_type ?? 'sessions' }}" value="1" required>
                <label class="form-check-label" for="terms_{{ $booking_type ?? 'sessions' }}">الموافقة على جميع <a href="{{ route('pages.show', ['slug' => 'terms']) }}" target="_blank">الشروط والأحكام</a></label>
            </div>
            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0 list-unstyled">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button class="main-button main-primary fill" type="submit">احجز الآن</button>
        </form>
    @else
        <p class="section-text mb-3">لتتمكن من الحجز يرجى تسجيل الدخول.</p>
        <a href="{{ route('login') }}?redirect={{ urlencode(request()->url()) }}" class="main-button main-primary fill">تسجيل الدخول للحجز</a>
    @endauth
</div>
