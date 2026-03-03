@php
    $userType = auth()->user()->user_type;

    // Define all available tabs with their properties
    $allTabs = [
        'editProfile' => [
            'icon' => '<path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.manage_profile'),
            'route' => 'profile.index',
            'types' => ['*'], // All users
        ],
        'wallet' => [
            'icon' => '<path d="M18.04 13.55C17.62 13.96 17.38 14.55 17.44 15.18C17.53 16.26 18.52 17.05 19.6 17.05H21.5V18.24C21.5 20.31 19.81 22 17.74 22H6.26C4.19 22 2.5 20.31 2.5 18.24V11.51C2.5 9.44001 4.19 7.75 6.26 7.75H17.74C19.81 7.75 21.5 9.44001 21.5 11.51V12.95H19.48C18.92 12.95 18.41 13.17 18.04 13.55Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2.5 12.4101V7.8401C2.5 6.6501 3.23 5.59006 4.34 5.17006L12.28 2.17006C13.52 1.70006 14.85 2.62009 14.85 3.95009V7.75008" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M22.5588 13.9702V16.0302C22.5588 16.5802 22.1188 17.0302 21.5588 17.0502H19.5988C18.5188 17.0502 17.5288 16.2602 17.4388 15.1802C17.3788 14.5502 17.6188 13.9602 18.0388 13.5502C18.4088 13.1702 18.9188 12.9502H21.5588C22.1188 12.9702 22.5588 13.4202 22.5588 13.9702Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7 12H14" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.wallet'),
            'route' => 'profile.wallet',
            'types' => ['*'],
        ],
        'bookings' => [
            'icon' => '<path d="M12.37 8.87988H17.62" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M6.38 8.87988L7.13 9.62988L9.38 7.37988" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.37 15.8799H17.62" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M6.38 15.8799L7.13 16.6299L9.38 14.3799" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.my_bookings'),
            'route' => 'profile.bookings',
            'types' => ['*'],
        ],
        'addresses' => [
            'icon' => '<path d="M12 13.4299C13.7231 13.4299 15.12 12.0331 15.12 10.3099C15.12 8.58681 13.7231 7.18994 12 7.18994C10.2769 7.18994 8.88 8.58681 8.88 10.3099C8.88 12.0331 10.2769 13.4299 12 13.4299Z" stroke="#292D32" stroke-width="1.5"></path><path d="M3.62001 8.49C5.59001 -0.169998 18.42 -0.159997 20.38 8.5C21.53 13.58 18.37 17.88 15.6 20.54C13.59 22.48 10.41 22.48 8.39001 20.54C5.63001 17.88 2.47001 13.57 3.62001 8.49Z" stroke="#292D32" stroke-width="1.5"></path>',
            'label' => __('profile.my_addresses'),
            'route' => 'profile.addresses',
            'types' => ['*'],
        ],
        'conversations' => [
            'icon' => '<path d="M17.98 10.79V14.79C17.98 15.05 17.97 15.3 17.94 15.54C17.71 18.24 16.12 19.58 13.19 19.58H12.79C12.54 19.58 12.3 19.7 12.15 19.9L10.95 21.5C10.42 22.21 9.56 22.21 9.03 21.5L7.82999 19.9C7.69999 19.73 7.41 19.58 7.19 19.58H6.79001C3.60001 19.58 2 18.79 2 14.79V10.79C2 7.86001 3.35001 6.27001 6.04001 6.04001C6.28001 6.01001 6.53001 6 6.79001 6H13.19C16.38 6 17.98 7.60001 17.98 10.79Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M21.98 6.79001V10.79C21.98 13.73 20.63 15.31 17.94 15.54C17.97 15.3 17.98 15.05 17.98 14.79V10.79C17.98 7.60001 16.38 6 13.19 6H6.79004C6.53004 6 6.28004 6.01001 6.04004 6.04001C6.27004 3.35001 7.86004 2 10.79 2H17.19C20.38 2 21.98 3.60001 21.98 6.79001Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.4955 13.25H13.5045" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.9955 13.25H10.0045" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M6.4955 13.25H6.5045" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.conversations'),
            'route' => 'profile.conversations',
            'types' => ['*'],
        ],
        'wishlist' => [
            'icon' => '<path d="M12.62 20.8101C12.28 20.9301 11.72 20.9301 11.38 20.8101C8.48 19.8201 2 15.6901 2 8.6901C2 5.6001 4.49 3.1001 7.56 3.1001C9.38 3.1001 10.99 3.9801 12 5.3401C13.01 3.9801 14.63 3.1001 16.44 3.1001C19.51 3.1001 22 5.6001 22 8.6901C22 15.6901 15.52 19.8201 12.62 20.8101Z" stroke="#363636" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.wishlist'),
            'route' => 'wishlist.index',
            'types' => ['*'],
        ],
        'horses' => [
            'icon' => '<path d="M15.6394 6.99243H16.0273" stroke="#292D32" stroke-width="1.6039" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.93506 4.96115C10.3506 3.84463 12.1225 3.21712 13.9738 3.21712C13.974 3.02414 13.9947 2.82825 14.0375 2.63198C14.3607 1.15068 15.8235 0.211775 17.3048 0.534931L16.6102 3.41493L18.1994 4.76695C19.0288 5.4726 19.5068 6.50671 19.5068 7.59571L23.0775 11.1803C23.7133 11.8186 23.6761 12.8619 22.9963 13.4532L21.9724 14.3439C21.3554 14.8806 20.4284 14.8484 19.8501 14.2702L18.7923 13.2123L16.5786 12.0581C16.023 12.4889 15.3254 12.7453 14.568 12.7453C12.7542 12.7453 11.2839 11.2749 11.2839 9.46115" stroke="#292D32" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M0.46875 11.3533L1.70569 10.8676C3.34233 10.2251 4.82555 9.26771 6.07317 8.05824" stroke="#292D32" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.4816 12.0955L12.0448 12.7277C11.1718 13.9913 10.5931 15.4344 10.351 16.9509C10.0855 18.6151 9.41486 20.1883 8.39828 21.5323L6.94141 23.5291" stroke="#292D32" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M0.46875 7.59839C2.0152 6.74179 3.97875 6.01181 5.67952 5.52169H3.62152C4.0162 5.18676 4.40372 4.83023 4.77103 4.46283M4.77103 4.46283C4.76545 4.4684 4.77656 4.4573 4.77103 4.46283ZM4.77103 4.46283C5.65505 3.58214 6.76805 2.93695 7.97048 2.5904L10.2177 1.94283H8.53819C10.4912 1.1264 12.6608 0.833342 14.8211 1.14065" stroke="#292D32" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.my_horses'),
            'route' => 'profile.horses',
            'types' => ['horse_owner', 'stable_owner'],
        ],
        'orders' => [
            'icon' => '<path d="M12.37 8.87988H17.62" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M6.38 8.87988L7.13 9.62988L9.38 7.37988" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.37 15.8799H17.62" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M6.38 15.8799L7.13 16.6299L9.38 14.3799" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.orders'),
            'route' => 'profile.orders',
            'types' => ['*'],
        ],
        'products' => [
            'icon' => '<path d="M3.17004 7.43994L12 12.5499L20.77 7.46994" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 21.61V12.54" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.93001 2.48004L4.59001 5.44004C3.38001 6.11004 2.39001 7.79004 2.39001 9.17004V14.82C2.39001 16.2 3.38001 17.88 4.59001 18.55L9.93001 21.52C11.07 22.15 12.94 22.15 14.08 21.52L19.42 18.55C20.63 17.88 21.62 16.2 21.62 14.82V9.17004C21.62 7.79004 20.63 6.11004 19.42 5.44004L14.08 2.47004C12.93 1.84004 11.07 1.84004 9.93001 2.48004Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>',
            'label' => __('profile.products'),
            'route' => null, // TODO: Add route when implemented
            'types' => ['store_owner'],
        ],
    ];

    // Filter tabs based on user type
    $visibleTabs = collect($allTabs)->filter(function ($tab) use ($userType) {
        return in_array('*', $tab['types']) || in_array($userType, $tab['types']);
    });
@endphp

<div class="profile__aside">
    <!-- Customer info -->
    <div class="profile__aside__info">
        <div class="profile__aside__info__img">
            @if(auth()->user()->getFirstMediaUrl('avatar'))
                <img class="img-fluid" src="{{ auth()->user()->getFirstMediaUrl('avatar') }}" alt="user">
            @else
                <img class="img-fluid" src="{{  asset('images/icons/user.webp') }}" alt="user">
            @endif
        </div>
        <div>
            <div class="profile__aside__info__name">{{ auth()->user()->name }}</div>
            <div class="profile__aside__info__email">{{ auth()->user()->email }}</div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="profile__aside__tabs nav-pills" id="pills-tab" role="tablist">
        @foreach($visibleTabs as $key => $tab)
            @php
                $isActive = false;
                if ($tab['route']) {
                    $isActive = request()->routeIs($tab['route']) || request()->routeIs($tab['route'] . '.*');
                }
            @endphp

            <a class="nav-link {{ $isActive ? 'active' : '' }}" href="{{ $tab['route'] ? route($tab['route']) : '#' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    {!! $tab['icon'] !!}
                </svg>
                <span>{{ $tab['label'] }}</span>
            </a>
        @endforeach

        <!-- Logout -->
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                    d="M8.90002 7.55999C9.21002 3.95999 11.06 2.48999 15.11 2.48999H15.24C19.71 2.48999 21.5 4.27999 21.5 8.74999V15.27C21.5 19.74 19.71 21.53 15.24 21.53H15.11C11.09 21.53 9.24002 20.08 8.91002 16.54"
                    stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M15 12H3.62" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path d="M5.85 8.6499L2.5 11.9999L5.85 15.3499" stroke="#292D32" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>{{ __('profile.logout') }}</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>