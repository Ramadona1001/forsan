<!-- start main packages section-->
<div class="mainPackages main-section bg-light mt-3 mt-lg-5">
    <div class="container">
        <div class="main-section__header">
            <h3 class="section-head text-center line">الباقات</h3>
        </div>
        <div class="main-section__wrapper">
            <div class="row">
                @foreach($packages as $package)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="mainPackages__item @if($package->is_recommended) recommended @endif">
                            <div class="head">{{ $package->name }}</div>
                            <div class="text">{{ $package->description }}</div>
                            <div class="price">{{ $package->price }} ريال</div>

                            @if($package->features)
                                <div class="subtitle">المزايا</div>
                                <ul class="main-list">
                                    @php
                                        $features = is_array($package->features) ? $package->features : [];
                                        $localizedFeatures = $features[app()->getLocale()] ?? $features['ar'] ?? [];
                                    @endphp
                                    @foreach($localizedFeatures as $feature)
                                        <li>
                                            <p class="text">{{ $feature }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <a class="main-primary main-button fill" href="#">اقراء المزيد</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- end main packages section-->