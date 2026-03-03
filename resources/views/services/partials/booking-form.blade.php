<form class="main-form" action="#" method="POST">
    @csrf
    <input type="hidden" name="service_id" value="{{ $service->id }}">

    {{-- Custom Form Fields (for services like Veterinarian) --}}
    @if($service->form_fields)
        @foreach($service->form_fields as $fieldName => $fieldConfig)
            <div class="form-group">
                <label class="form-label" for="{{ $fieldName }}-{{ $service->id }}">
                    {{ $fieldConfig['label'][app()->getLocale()] ?? $fieldConfig['label']['ar'] }}
                </label>

                @if($fieldConfig['type'] === 'select')
                    <select class="form-select" id="{{ $fieldName }}-{{ $service->id }}" name="{{ $fieldName }}">
                        <option value="">{{ $fieldConfig['label'][app()->getLocale()] ?? $fieldConfig['label']['ar'] }}</option>
                        @foreach($fieldConfig['options'] as $option)
                            <option value="{{ $option['en'] }}">
                                {{ $option[app()->getLocale()] ?? $option['ar'] }}
                            </option>
                        @endforeach
                    </select>
                @elseif($fieldConfig['type'] === 'textarea')
                    <textarea class="form-control" id="{{ $fieldName }}-{{ $service->id }}" name="{{ $fieldName }}" rows="4"
                        placeholder="{{ $fieldConfig['placeholder'][app()->getLocale()] ?? $fieldConfig['placeholder']['ar'] }}"></textarea>
                @else
                    <input class="form-control" type="text" id="{{ $fieldName }}-{{ $service->id }}" name="{{ $fieldName }}"
                        placeholder="{{ $fieldConfig['placeholder'][app()->getLocale()] ?? ($fieldConfig['placeholder']['ar'] ?? '') }}">
                @endif
            </div>
        @endforeach
    @endif

    <div class="form-group">
        <label class="form-label">{{ __('al_mwaeyd_al_mtahh') ?? 'المواعيد المتاحه' }}</label>
        <div class="row">
            <div class="col-6">
                <select class="form-select" name="availableDays" required>
                    <option class="disabled" data-display="{{ __('akhter_al_youm') ?? 'اختر اليوم' }}">
                        {{ __('akhter_al_youm') ?? 'اختر اليوم' }}
                    </option>
                    <option value="1">الاحد (16/5/2025)</option>
                    <option value="2">الاتنين (17/5/2025)</option>
                    <option value="3">الثلاثاء (18/5/2025)</option>
                    <option value="4">الخميس (20/5/2025)</option>
                </select>
            </div>
            <div class="col-6">
                <select class="form-select" name="availableHours" required>
                    <option class="disabled" data-display="{{ __('akhter_al_saah') ?? 'اختر الساعه' }}">
                        {{ __('akhter_al_saah') ?? 'اختر الساعه' }}
                    </option>
                    <option value="1">12:00 PM</option>
                    <option value="2">13:00 PM</option>
                    <option value="3">14:00 PM</option>
                    <option value="4">15:00 PM</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="terms-conditions-{{ $service->id }}" name="terms-conditions"
            value="true" required>
        <label class="form-check-label" for="terms-conditions-{{ $service->id }}">
            {{ __('al_mwafqh_aly_jmy') ?? 'الموافقه علي جميع' }} <a
                href="#">{{ __('al_shrout_w_al_ahkam') ?? 'الشروط و الاحكام' }} </a></label>
    </div>
    <button class="main-button main-primary fill" type="submit">{{ __('ahjz_alan') ?? 'احجز الان' }}</button>
</form>