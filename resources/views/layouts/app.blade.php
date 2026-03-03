<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Steps of Knights - خطى الفرسان')</title>
    <link rel="shortcut icon" href="{{ ($siteSettings ?? null)?->getFaviconUrl() ?? asset('images/logo/favicon.webp') }}" type="image/x-icon" />

    <!-- bootstrap-icons style CDN-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <!-- owl.carousel style CDN-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <!-- nice-select style CDN-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
    <!-- fancy box style CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />
    <!-- Date Range Picker style CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- leaflet style CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    @if(app()->getLocale() == 'ar')
        <!-- animation style RTL -->
        <link rel="stylesheet" href="{{ asset('css/vendor/animation-rtl.css') }}" />
        <!-- bootstrap rtl style CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.rtl.min.css" />
        <link rel="stylesheet" href="{{ asset('css/main-rtl.css') }}" />
    @else
        <!-- animation style LTR -->
        <link rel="stylesheet" href="{{ asset('css/vendor/animation-ltr.css') }}" />
        <!-- bootstrap ltr style CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ asset('css/main-ltr.css') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('css/card-actions.css') }}">
    @stack('styles')
</head>

<body>
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scroll To Top -->
    <button class="main-button scrollTo" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Scroll Top"><i
            class="bi bi-arrow-up"></i></button>

    <!-- Fixed Social Icons -->
    @auth
        <div class="fixed-social">
            <a class="fixed-icon secondary" href="{{ route('profile.conversations') }}" data-bs-toggle="tooltip"
                data-bs-placement="left" data-bs-title="{{ __('general.conversations') }}">
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.3079 29.5849C12.3676 30.6821 14.6663 31.2541 17 31.2501C24.8701 31.2501 31.25 24.8701 31.25 17.0001C31.25 9.13 24.8701 2.75007 17 2.75007C9.12993 2.75007 2.75 9.13 2.75 17.0001C2.75 19.4226 3.35393 21.7012 4.41793 23.6962C4.66617 24.161 4.72455 24.7039 4.58078 25.2108L2.90607 31.0967L8.79336 29.4234C9.30009 29.2792 9.84299 29.3371 10.3079 29.5849ZM17 33.2858C14.332 33.2896 11.7043 32.6351 9.34978 31.3804L2.87621 33.222C2.58562 33.3046 2.27824 33.308 1.98587 33.232C1.69349 33.156 1.4267 33.0033 1.21309 32.7897C0.999477 32.5761 0.846781 32.3093 0.77078 32.0169C0.69478 31.7245 0.698234 31.4172 0.780784 31.1266L2.62107 24.653C1.36543 22.2978 0.710465 19.6691 0.714284 17.0001C0.714284 8.00628 8.00621 0.714355 17 0.714355C25.9938 0.714355 33.2857 8.00628 33.2857 17.0001C33.2857 25.9939 25.9938 33.2858 17 33.2858ZM10.8929 13.9465C10.8929 13.6765 11.0001 13.4177 11.191 13.2268C11.3819 13.0359 11.6408 12.9286 11.9107 12.9286H22.0893C22.3592 12.9286 22.6181 13.0359 22.809 13.2268C22.9999 13.4177 23.1071 13.6765 23.1071 13.9465C23.1071 14.2165 22.9999 14.4753 22.809 14.6662C22.6181 14.8571 22.3592 14.9644 22.0893 14.9644H11.9107C11.6408 14.9644 11.3819 14.8571 11.191 14.6662C11.0001 14.4753 10.8929 14.2165 10.8929 13.9465ZM10.8929 20.0536C10.8929 19.7837 11.0001 19.5248 11.191 19.3339C11.3819 19.143 11.6408 19.0358 11.9107 19.0358H18.0179C18.2878 19.0358 18.5467 19.143 18.7376 19.3339C18.9285 19.5248 19.0357 19.7837 19.0357 20.0536C19.0357 20.3236 18.9285 20.5825 18.7376 20.7734C18.5467 20.9643 18.2878 21.0715 18.0179 21.0715H11.9107C11.6408 21.0715 11.3819 20.9643 11.191 20.7734C11.0001 20.5825 10.8929 20.3236 10.8929 20.0536Z"
                        fill="white"></path>
                </svg>
            </a>
        </div>
    @endauth

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts -->
    <!-- jquery script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- bootstrap script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <!-- owl.carousel script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- wow script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!-- lazy script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.min.js"></script>
    <!-- nice-select script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- Counter-Up script CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <!-- fancy box script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <!-- Date Range Picker script CDN-->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- leaflet script CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/owl-init.js') }}" type="module"></script>
    <script src="{{ asset('js/script.js') }}" type="module"></script>
    <script src="{{ asset('js/ajax-actions.js') }}"></script>

    @stack('scripts')
</body>

</html>