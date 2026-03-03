{{-- Start top navbar --}}
<div class="top-navbar">
    <div class="container">
        <div class="top-navbar__wrapper">
            <ul class="top-navbar__navbar">
                {{-- Profile Icon --}}
                <li class="nav-item">
                    <a class="nav-link custom-toggler" data-target="#dropdown-profile" href="javascript:void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path
                                d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </a>
                </li>
                {{-- Notification Icon --}}
                <li class="nav-item">
                    <a class="nav-link custom-toggler" data-target="#dropdown-notification" href="javascript:void(0)">
                        <div class="badge">0</div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.02 2.90991C8.70997 2.90991 6.01997 5.59991 6.01997 8.90991V11.7999C6.01997 12.4099 5.75997 13.3399 5.44997 13.8599L4.29997 15.7699C3.58997 16.9499 4.07997 18.2599 5.37997 18.6999C9.68997 20.1399 14.34 20.1399 18.65 18.6999C19.86 18.2999 20.39 16.8699 19.73 15.7699L18.58 13.8599C18.28 13.3399 18.02 12.4099 18.02 11.7999V8.90991C18.02 5.60991 15.32 2.90991 12.02 2.90991Z"
                                stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round">
                            </path>
                            <path
                                d="M13.87 3.19994C13.56 3.10994 13.24 3.03994 12.91 2.99994C11.95 2.87994 11.03 2.94994 10.17 3.19994C10.46 2.45994 11.18 1.93994 12.02 1.93994C12.86 1.93994 13.58 2.45994 13.87 3.19994Z"
                                stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path
                                d="M15.02 19.0601C15.02 20.7101 13.67 22.0601 12.02 22.0601C11.2 22.0601 10.44 21.7201 9.90002 21.1801C9.36002 20.6401 9.02002 19.8801 9.02002 19.0601"
                                stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"></path>
                        </svg>
                    </a>
                </li>
                {{-- Compare Icon --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('compare.index') }}" data-ajax-badge="compare">
                        <div class="badge">
                            {{ count(session('compare_products', [])) + count(session('compare_horses', [])) }}
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.28 10.45L21 6.72998L17.28 3.01001" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3 6.72998H21" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M6.71997 13.55L3 17.27L6.71997 20.99" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21 17.27H3" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </li>
                {{-- Wishlist Icon --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('wishlist.index') }}" data-ajax-badge="wishlist">
                        <div class="badge">
                            {{ count(session('wishlist_products', [])) + count(session('wishlist_horses', [])) }}
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M12.62 20.8101C12.28 20.9301 11.72 20.9301 11.38 20.8101C8.48 19.8201 2 15.6901 2 8.6901C2 5.6001 4.49 3.1001 7.56 3.1001C9.38 3.1001 10.99 3.9801 12 5.3401C13.01 3.9801 14.63 3.1001 16.44 3.1001C19.51 3.1001 22 5.6001 22 8.6901C22 15.6901 15.52 19.8201 12.62 20.8101Z"
                                stroke="#363636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </a>
                </li>
                {{-- Cart Icon Mobile --}}
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link custom-toggler" data-target="#dropdown-cart" href="javascript:void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M2 2H3.74001C4.82001 2 5.67 2.93 5.58 4L4.75 13.96C4.61 15.59 5.89999 16.99 7.53999 16.99H18.19C19.63 16.99 20.89 15.81 21 14.38L21.54 6.88C21.66 5.22 20.4 3.87 18.73 3.87H5.82001"
                                stroke="#363636" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path
                                d="M16.25 22C16.9404 22 17.5 21.4404 17.5 20.75C17.5 20.0596 16.9404 19.5 16.25 19.5C15.5596 19.5 15 20.0596 15 20.75C15 21.4404 15.5596 22 16.25 22Z"
                                stroke="#363636" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path
                                d="M8.25 22C8.94036 22 9.5 21.4404 9.5 20.75C9.5 20.0596 8.94036 19.5 8.25 19.5C7.55964 19.5 7 20.0596 7 20.75C7 21.4404 7.55964 22 8.25 22Z"
                                stroke="#363636" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M9 8H21" stroke="#363636" stroke-width="1.5" stroke-miterlimit="10"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </li>
                {{-- Search Icon --}}
                <li class="nav-item">
                    <a class="nav-link custom-toggler" data-target="#dropdown-search" href="javascript:void(0)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"
                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M22 22L20 20" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </li>
            </ul>
            <ul class="top-navbar__navbar">
                {{-- Language Dropdown --}}
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}"
                                href="{{ route('locale', 'ar') }}">العربية</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                href="{{ route('locale', 'en') }}">English</a></li>
                    </ul>
                </li>
                {{-- Currency Dropdown --}}
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">ريال</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:void(0)">دولار</a></li>
                        <li><a class="dropdown-item active" href="javascript:void(0)">ريال سعودي</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">جنية مصري</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">يورو</a></li>
                    </ul>
                </li>
            </ul>

            {{-- Profile Dropdown --}}
            <div class="custom-dropdown" id="dropdown-profile">
                <div class="dropdown-scroll-wrapper">
                    <ul>
                        @guest
                            <li>
                                <a class="profile-item" href="{{ route('login') }}">
                                    <p class="profile-item__title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12"
                                                stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M22 2L13.8 10.2" stroke="#292D32" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M13 6.17004V11H17.83" stroke="#292D32" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <span>{{ __('general.login') }}</span>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <a class="profile-item" href="{{ route('register') }}">
                                    <p class="profile-item__title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path
                                                d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z"
                                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M3.40991 22C3.40991 18.13 7.25991 15 11.9999 15C12.9599 15 13.8899 15.13 14.7599 15.37"
                                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M22 18C22 18.32 21.96 18.63 21.88 18.93C21.79 19.33 21.63 19.72 21.42 20.06C20.73 21.22 19.46 22 18 22C16.97 22 16.04 21.61 15.34 20.97C15.04 20.71 14.78 20.4 14.58 20.06C14.21 19.46 14 18.75 14 18C14 16.92 14.43 15.93 15.13 15.21C15.86 14.46 16.88 14 18 14C19.18 14 20.25 14.51 20.97 15.33C21.61 16.04 22 16.98 22 18Z"
                                                stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M19.49 17.98H16.51" stroke="#292D32" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M18 16.52V19.51" stroke="#292D32" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                        <span>{{ __('general.register') }}</span>

                                    </p>
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="profile-item" href="{{ route('profile.index') }}">
                                    <p class="profile-item__title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path
                                                d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z"
                                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22"
                                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        <span>{{ __('general.my_account') }}</span>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <a class="profile-item" href="{{ route('profile.wallet') }}">
                                    <p class="profile-item__title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path
                                                d="M18.04 13.55C17.62 13.96 17.38 14.55 17.44 15.18C17.53 16.26 18.52 17.05 19.6 17.05H21.5V18.24C21.5 20.31 19.81 22 17.74 22H6.26C4.19 22 2.5 20.31 2.5 18.24V11.51C2.5 9.44001 4.19 7.75 6.26 7.75H17.74C19.81 7.75 21.5 9.44001 21.5 11.51V12.95H19.48C18.92 12.95 18.41 13.17 18.04 13.55Z"
                                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M2.5 12.4101V7.8401C2.5 6.6501 3.23 5.59006 4.34 5.17006L12.28 2.17006C13.52 1.70006 14.85 2.62009 14.85 3.95009V7.75008"
                                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M7 12H14" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        <span>{{ __('general.wallet') }}</span>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <a class="profile-item" href="{{ route('profile.orders') }}">
                                    <p class="profile-item__title">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.37 8.87988H17.62" stroke="#292D32" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.38 8.87988L7.13 9.62988L9.38 7.37988" stroke="#292D32"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.37 15.8799H17.62" stroke="#292D32" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.38 15.8799L7.13 16.6299L9.38 14.3799" stroke="#292D32"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path
                                                d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                                stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        <span>{{ __('general.orders') }}</span>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <a class="profile-item" href="{{ route('profile.bookings') }}">
                                    <p class="profile-item__title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path d="M8 2V5" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16 2V5" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3.5 9.09009H20.5" stroke="#292D32" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path
                                                d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                                stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <span>{{ __('general.bookings') }}</span>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <a class="profile-item" href="{{ route('profile.horses') }}">
                                    <p class="profile-item__title">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.6394 6.99243H16.0273" stroke="#292D32" stroke-width="1.6039"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path
                                                d="M8.93506 4.96115C10.3506 3.84463 12.1225 3.21712 13.9738 3.21712C13.974 3.02414 13.9947 2.82825 14.0375 2.63198C14.3607 1.15068 15.8235 0.211775 17.3048 0.534931L16.6102 3.41493L18.1994 4.76695C19.0288 5.4726 19.5068 6.50671 19.5068 7.59571L23.0775 11.1803C23.7133 11.8186 23.6761 12.8619 22.9963 13.4532L21.9724 14.3439C21.3554 14.8806 20.4284 14.8484 19.8501 14.2702L18.7923 13.2123L16.5786 12.0581C16.023 12.4889 15.3254 12.7453 14.568 12.7453C12.7542 12.7453 11.2839 11.2749 11.2839 9.46115"
                                                stroke="#292D32" stroke-miterlimit="10" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        <span>{{ __('general.horses_menu') }}</span>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <a class="profile-item" href="{{ route('profile.addresses') }}">
                                    <p class="profile-item__title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path
                                                d="M12 13.4299C13.7231 13.4299 15.12 12.0331 15.12 10.3099C15.12 8.58681 13.7231 7.18994 12 7.18994C10.2769 7.18994 8.88 8.58681 8.88 10.3099C8.88 12.0331 10.2769 13.4299 12 13.4299Z"
                                                stroke="#292D32" stroke-width="1.5"></path>
                                            <path
                                                d="M3.62001 8.49C5.59001 -0.169998 18.42 -0.159997 20.38 8.5C21.53 13.58 18.37 17.88 15.6 20.54C13.59 22.48 10.41 22.48 8.39001 20.54C5.63001 17.88 2.47001 13.57 3.62001 8.49Z"
                                                stroke="#292D32" stroke-width="1.5"></path>
                                        </svg>
                                        <span>{{ __('general.addresses') }}</span>

                                    </p>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <a class="profile-item" href="javascript:void(0)"
                                        onclick="document.getElementById('logout-form').submit()">
                                        <p class="profile-item__title">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M8.90002 7.56023C9.21002 3.96023 11.06 2.49023 15.11 2.49023H15.24C19.71 2.49023 21.5 4.28023 21.5 8.75023V15.2702C21.5 19.7402 19.71 21.5302 15.24 21.5302H15.11C11.09 21.5302 9.24002 20.0802 8.91002 16.5402"
                                                    stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M15 12H3.62" stroke="#292D32" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M5.85 8.65039L2.5 12.0004L5.85 15.3504" stroke="#292D32"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                            <span>{{ __('general.logout') }}</span>

                                        </p>
                                    </a>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

            {{-- Notification Dropdown --}}
            <div class="custom-dropdown" id="dropdown-notification">
                <div class="dropdown-notification__head">
                    <h3>{{ __('general.notifications') }}</h3>

                </div>
                <div class="dropdown-notification__body">
                    {{-- Notifications will be loaded dynamically --}}
                </div>
                <div class="dropdown-notification__empty">
                    <i class="bi bi-bell-slash"></i>
                    <h3>{{ __('general.no_notifications') }}</h3>

                </div>
                <div class="dropdown-notification__footer">
                    <a class="main-button main-primary fill" href="#">{{ __('general.view_all_notifications') }}</a>

                </div>
            </div>

            {{-- Search Dropdown --}}
            <div class="dropdown-search custom-dropdown" id="dropdown-search">
                <form action="{{ route('search') }}" method="GET">
                    <div class="form-group">
                        <input class="form-control" type="search" name="q"
                            placeholder="{{ __('general.search_placeholder') }}">

                        <i class="bi bi-search"></i>
                    </div>
                </form>
                <div class="dropdown-search" id="dropdown-searchResult">
                    <div class="dropdown-search__empty d-none">
                        <i class="bi bi-emoji-frown"></i>
                        <h3>{{ __('general.search_no_results') }}</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End top navbar --}}

{{-- Header Start --}}
<header class="sticky-header" id="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="nav-mob">
                <a class="navbar-brand" href="{{ route('home') }}">
<img class="logo img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                </a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="offcanvas-lg offcanvas-start side-nav-bar" id="navbarSupportedContent">
                <div class="offcanvas-header">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img class="img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                    </a>
                    <button class="btn-close" type="button" data-bs-dismiss="offcanvas"
                        data-bs-target="#navbarSupportedContent" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <a class="navbar-brand d-none d-lg-block" href="{{ route('home') }}">
                        <img class="logo img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                    </a>
                    <ul class="navbar-nav mb-lg-0 nav-mobile">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">{{ __('general.home') }}</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-toggler" data-target="#dropdown-services"
                                href="javascript:void(0)">
                                {{ __('general.services') }} <i class="bi bi-chevron-down"></i>

                            </a>
                            {{-- Services Dropdown --}}
                            <div class="custom-dropdown has-children" id="dropdown-services">
                                <div class="dropdown-scroll-wrapper">
                                    <ul>
                                        <li>
                                            <a class="products-item" href="{{ route('services.horse-reviews.index') }}">
                                                <p class="products-item__title">
                                                    <span>{{ __('services.horse_reviews') }}</span>
                                                </p>
                                            </a>
                                        </li>
                                        {{-- Photography Services --}}
                                        @php
                                            $photographyServices = \App\Models\Photography::where('is_active', true)->get();
                                        @endphp
                                        @if($photographyServices->count() > 0)
                                            <li class="children-parent">
                                                <a class="products-item custom-toggler"
                                                    data-target="#dropdown-service-photography" href="javascript:void(0)">
                                                    <p class="products-item__title">
                                                        <span>{{ __('services.photography_services') }}</span>
                                                        <i class="bi bi-chevron-left"></i>
                                                    </p>
                                                </a>
                                                <ul class="custom-dropdown" id="dropdown-service-photography">
                                                    @foreach($photographyServices as $service)
                                                        <li>
                                                            <a class="products-item"
                                                                href="{{ route('services.photography.show', $service->slug) }}">
                                                                <p class="products-item__title">
                                                                    <span>{{ $service->title }}</span>
                                                                </p>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                        {{-- @php
                                        $categories = \App\Models\Category::where('type',
                                        'service')->whereNull('parent_id')->where('is_active', true)->get();
                                        @endphp
                                        @foreach($categories as $category)
                                        @if($category->children->count() > 0)
                                        <li class="children-parent">
                                            <a class="products-item custom-toggler"
                                                data-target="#dropdown-service-{{ $category->id }}"
                                                href="javascript:void(0)">
                                                <p class="products-item__title">
                                                    <span>{{ $category->getTranslation('name', app()->getLocale())
                                                        }}</span>
                                                    <i class="bi bi-chevron-left"></i>
                                                </p>
                                            </a>
                                            <ul class="custom-dropdown" id="dropdown-service-{{ $category->id }}">
                                                @foreach($category->children as $child)
                                                <li>
                                                    <a class="products-item" href="#"> --}}
                                                        {{-- href="{{ route('services.show', $child->slug) }}" --}}
                                                        {{-- <p class="products-item__title">
                                                            <span>{{ $child->getTranslation('name', app()->getLocale())
                                                                }}</span>
                                                        </p>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @else
                                        <li>
                                            <a class="products-item" href="#"> --}}
                                                {{-- href="{{ route('services.show', $category->slug) }}" --}}
                                                {{-- <p class="products-item__title">
                                                    <span>{{ $category->getTranslation('name', app()->getLocale())
                                                        }}</span>
                                                </p>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('stores.*') ? 'active' : '' }}"
                                href="{{ route('stores.index') }}">{{ __('general.stores') }}</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('stables.*') ? 'active' : '' }}"
                                href="{{ route('stables.index') }}">{{ __('general.stables') }}</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('horses.*') ? 'active' : '' }}"
                                href="{{ route('horses.index') }}">{{ __('general.horses_menu') }}</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}"
                                href="{{ route('blogs.index') }}">{{ __('general.blog') }}</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                href="{{ route('about') }}">{{ __('general.about_us') }}</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">{{ __('general.contact_us') }}</a>

                        </li>
                    </ul>
                    @php
                        $headerCart = auth()->check()
                            ? \App\Models\Cart::where('user_id', auth()->id())->with('items.product.media')->first()
                            : \App\Models\Cart::where('session_id', session()->getId())->with('items.product.media')->first();
                        $cartItems = $headerCart ? $headerCart->items : collect();
                        $cartTotal = $headerCart ? $headerCart->getSubtotal() : 0;
                        $cartCount = $headerCart ? $headerCart->getItemsCount() : 0;
                    @endphp
                    <div class="cart-wrapper position-relative">
                        <a class="nav-link custom-toggler" data-target="#dropdown-cart" href="javascript:void(0)">
                            <span class="position-relative d-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M2 2H3.74001C4.82001 2 5.67 2.93 5.58 4L4.75 13.96C4.61 15.59 5.89999 16.99 7.53999 16.99H18.19C19.63 16.99 20.89 15.81 21 14.38L21.54 6.88C21.66 5.22 20.4 3.87 18.73 3.87H5.82001"
                                        stroke="#363636" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M16.25 22C16.9404 22 17.5 21.4404 17.5 20.75C17.5 20.0596 16.9404 19.5 16.25 19.5C15.5596 19.5 15 20.0596 15 20.75C15 21.4404 15.5596 22 16.25 22Z"
                                        stroke="#363636" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M8.25 22C8.94036 22 9.5 21.4404 9.5 20.75C9.5 20.0596 8.94036 19.5 8.25 19.5C7.55964 19.5 7 20.0596 7 20.75C7 21.4404 7.55964 22 8.25 22Z"
                                        stroke="#363636" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9 8H21" stroke="#363636" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                @if($cartCount > 0)
                                    <span class="cart-count-badge" style="position:absolute;top:-8px;right:-10px;min-width:20px;height:20px;padding:0 6px;font-size:12px;font-weight:700;line-height:20px;text-align:center;color:#fff!important;background:#0c4745!important;border-radius:999px;border:2px solid #fff;box-shadow:0 1px 6px rgba(0,0,0,.25);display:inline-flex;align-items:center;justify-content:center;">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
                                @endif
                            </span>
                            <p>{{ __('general.cart') }}</p>

                        </a>
                    </div>
                </div>
            </div>

            {{-- Cart Dropdown --}}
            <div class="custom-dropdown" id="dropdown-cart">
                <div class="dropdown-cart__head">
                    <h3>{{ __('general.cart_items') }}</h3>

                </div>
                <div class="dropdown-cart__body">
                    @forelse($cartItems as $item)
                        <div class="cart-item">
                            <div class="cart-item__img">
                                <img class="img-fluid"
                                    src="{{ $item->product->getFirstMediaUrl('main_image') ?: asset('images/statec.webp') }}"
                                    alt="img">
                            </div>
                            <div class="cart-item__content">
                                <h3>{{ $item->product->getTranslation('name', app()->getLocale()) }}</h3>
                                <p>{{ number_format($item->product->price, 2) }} ر.س <span>{{ $item->quantity }}X</span></p>
                            </div>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-item"><i class="bi bi-x-lg"></i></button>
                            </form>
                        </div>
                    @empty
                        {{-- Empty cart message will show --}}
                    @endforelse
                </div>
                @if($cartItems->isEmpty())
                    <div class="dropdown-cart__empty">
                        <i class="bi bi-emoji-frown"></i>
                        <h3>{{ __('general.cart_empty') }}</h3>

                    </div>
                @else
                    <div class="dropdown-cart__count">
                        <p>{{ __('general.subtotal') }} <span>{{ number_format($cartTotal, 2) }}
                                {{ __('general.sar_currency') }}</span></p>

                    </div>
                @endif
                <div class="dropdown-cart__footer">
                    <a class="main-button main-primary fill"
                        href="{{ route('cart.index') }}">{{ __('general.view_cart') }}</a>

                </div>
            </div>
        </div>
    </nav>
</header>
{{-- Header End --}}

@push('styles')
<style>
/* عداد السلة - لون الثيم الأخضر الغامق (primary) */
header .cart-wrapper .cart-count-badge,
.cart-wrapper .nav-link .cart-count-badge,
.cart-count-badge {
    position: absolute !important;
    top: -8px !important;
    right: -10px !important;
    min-width: 20px !important;
    height: 20px !important;
    padding: 0 6px !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    line-height: 20px !important;
    text-align: center !important;
    color: #fff !important;
    background-color: var(--primary-color, #0c4745) !important;
    border-radius: 999px !important;
    border: 2px solid #fff !important;
    box-shadow: 0 1px 6px rgba(0,0,0,0.2) !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
[dir="rtl"] .cart-count-badge { right: auto !important; left: -10px !important; }
.cart-wrapper .nav-link span:first-child { display: inline-flex; align-items: center; justify-content: center; }
/* تأكيد وضوح الرقم الأبيض حتى مع وراثة لون الرابط */
.cart-count-badge { color: #fff !important; -webkit-text-fill-color: #fff !important; }
</style>
@endpush

{{-- Preloader --}}
<div class="preloader-parent">
    <div class="preloader">
        <img class="logo-preloader img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="">
    </div>
</div>
