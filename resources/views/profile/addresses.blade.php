@extends('layouts.app')

@section('title', __('profile.my_addresses') . ' - ' . config('app.name'))

@section('content')
<section class="profile">
    <div class="container">
        <div class="profile__header">
            <button class="navbar-toggler shadow-none main-button main-primary fill" type="button" 
                    data-bs-toggle="offcanvas" data-bs-target="#navbarUser">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M3 4.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M3 9.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M3 14.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M3 19.5H21" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-xl-4">
                <div class="offcanvas-xl offcanvas-start" id="navbarUser">
                    <div class="offcanvas-header">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img class="img-fluid" src="{{ ($siteSettings ?? null)?->getLogoUrl() ?? asset('images/logo/logo.webp') }}" alt="logo" title="logo">
                        </a>
                        <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#navbarUser"></button>
                    </div>
                    <div class="offcanvas-body">
                        @include('profile.partials.sidebar')
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-xl-8">
                <div class="profile__content tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="profile__content__header">
                                <h3>{{ __('profile.my_addresses') }}</h3>

                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($addresses->count() > 0)
                            <div class="addresses">
                                @foreach($addresses as $address)
                                    <div data-coordinates="{{ $address->latitude ?? '' }}, {{ $address->longitude ?? '' }}">
                                        <div class="addresses__item">
                                            @if($address->is_default)
                                                <div class="default_address">{{ __('profile.default') }}</div>

                                            @endif
                                            
                                            <div class="addresses__item__type">
                                                <h4 class="section-head">{{ $address->type }}</h4>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input address-radio" 
                                                           id="address-{{ $address->id }}" 
                                                           type="radio" 
                                                           role="switch" 
                                                           name="selected-address"
                                                           value="{{ $address->id }}"
                                                           {{ $address->is_default ? 'checked' : '' }}
                                                           data-address-id="{{ $address->id }}">
                                                </div>
                                            </div>

                                            <div class="addresses__item__address">
                                                <p class="section-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M12 13.4299C13.7231 13.4299 15.12 12.0331 15.12 10.3099C15.12 8.58681 13.7231 7.18994 12 7.18994C10.2769 7.18994 8.88 8.58681 8.88 10.3099C8.88 12.0331 10.2769 13.4299 12 13.4299Z" stroke="#292D32" stroke-width="1.5"></path>
                                                        <path d="M3.62001 8.49C5.59001 -0.169998 18.42 -0.159997 20.38 8.5C21.53 13.58 18.37 17.88 15.6 20.54C13.59 22.48 10.41 22.48 8.39001 20.54C5.63001 17.88 2.47001 13.57 3.62001 8.49Z" stroke="#292D32" stroke-width="1.5"></path>
                                                    </svg>
                                                    {{ $address->street }} - {{ $address->city }} - {{ $address->country }}
                                                </p>
                                                
                                                <div class="section-buttons">
                                                    <button type="button" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editAddressModal"
                                                            data-address-id="{{ $address->id }}"
                                                            data-address-type="{{ $address->type }}"
                                                            data-address-street="{{ $address->street }}"
                                                            data-address-city="{{ $address->city }}"
                                                            data-address-country="{{ $address->country }}">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M16.04 3.02001L8.16 10.9C7.86 11.2 7.56 11.79 7.5 12.22L7.07 15.23C6.91 16.32 7.68 17.08 8.77 16.93L11.78 16.5C12.2 16.44 12.79 16.14 13.1 15.84L20.98 7.96001C22.34 6.60001 22.98 5.02001 20.98 3.02001C18.98 1.02001 17.4 1.66001 16.04 3.02001Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M14.91 4.1499C15.58 6.5399 17.45 8.4099 19.85 9.0899" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                    
                                                    <button type="button" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteAddressModal"
                                                            data-address-id="{{ $address->id }}">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.79002C6.00002 22 5.91002 20.78 5.80002 19.21L5.15002 9.14001" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M10.33 16.5H13.66" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.5 12.5H14.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="profile__empty">
                                <img class="img-fluid" src="{{ asset('images/icons/addresses.svg') }}" alt="{{ __('profile.no_addresses') }}">

                                <h3>{{ __('profile.no_addresses') }}</h3>

                            </div>
                        @endif

                        <button class="main-button main-primary fill w-100 mt-3" 
                                type="button" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addAddressModal">
                            {{ __('profile.add_new_address') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressModalLabel">{{ __('profile.add_new_address') }}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="type" class="form-label">{{ __('profile.address_type') }}</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="{{ __('profile.example_type') }}" required>

                    </div>
                    <div class="form-group mb-3">
                        <label for="street" class="form-label">{{ __('profile.street') }}</label>

                        <input type="text" class="form-control" id="street" name="street" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="city" class="form-label">{{ __('profile.city') }}</label>

                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="country" class="form-label">{{ __('profile.country') }}</label>

                        <input type="text" class="form-control" id="country" name="country" value="{{ __('profile.saudi_arabia') }}" required>

                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_default" name="is_default" value="1">
                        <label class="form-check-label" for="is_default">
                            {{ __('profile.set_as_default') }}

                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="main-button main-secondary rgb" data-bs-dismiss="modal">{{ __('profile.cancel') }}</button>

                    <button type="submit" class="main-button main-primary fill">{{ __('profile.save_address') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">{{ __('profile.edit_address') }}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAddressForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="edit_type" class="form-label">{{ __('profile.address_type') }}</label>

                        <input type="text" class="form-control" id="edit_type" name="type" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_street" class="form-label">{{ __('profile.street') }}</label>

                        <input type="text" class="form-control" id="edit_street" name="street" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_city" class="form-label">{{ __('profile.city') }}</label>

                        <input type="text" class="form-control" id="edit_city" name="city" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_country" class="form-label">{{ __('profile.country') }}</label>

                        <input type="text" class="form-control" id="edit_country" name="country" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="main-button main-secondary rgb" data-bs-dismiss="modal">{{ __('profile.cancel') }}</button>

                    <button type="submit" class="main-button main-primary fill">{{ __('profile.save_changes') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Address Modal -->
<div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAddressModalLabel">{{ __('profile.delete_address') }}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteAddressForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>{{ __('profile.confirm_delete_address') }}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="main-button main-secondary rgb" data-bs-dismiss="modal">{{ __('profile.cancel') }}</button>

                    <button type="submit" class="main-button main-trash fill">{{ __('profile.delete') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Handle edit modal
document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editAddressModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const addressId = button.getAttribute('data-address-id');
            const type = button.getAttribute('data-address-type');
            const street = button.getAttribute('data-address-street');
            const city = button.getAttribute('data-address-city');
            const country = button.getAttribute('data-address-country');

            const form = document.getElementById('editAddressForm');
            form.action = `/profile/addresses/${addressId}`;
            
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_street').value = street;
            document.getElementById('edit_city').value = city;
            document.getElementById('edit_country').value = country;
        });
    }

    // Handle delete modal
    const deleteModal = document.getElementById('deleteAddressModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const addressId = button.getAttribute('data-address-id');
            
            const form = document.getElementById('deleteAddressForm');
            form.action = `/profile/addresses/${addressId}`;
        });
    }

    // Handle default address radio
    document.querySelectorAll('.address-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                const addressId = this.getAttribute('data-address-id');
                fetch(`/profile/addresses/${addressId}/set-default`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        });
    });
});
</script>
@endsection