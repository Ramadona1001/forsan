<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\StableController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Language Switcher
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('locale');

// Home & Static Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');

Route::get('/collaboration', [\App\Http\Controllers\CollaborationController::class, 'index'])->name('collaboration.index');
Route::get('/collaboration/{slug}', [\App\Http\Controllers\CollaborationController::class, 'showRequest'])->name('collaboration.request');
Route::post('/collaboration/{slug}', [\App\Http\Controllers\CollaborationController::class, 'submitRequest'])->name('collaboration.submit');

// Horses
Route::prefix('horses')->name('horses.')->group(function () {
    Route::get('/', [HorseController::class, 'index'])->name('index');
    Route::get('/{horse}', [HorseController::class, 'show'])->name('show');
});

// Stables
Route::prefix('stables')->name('stables.')->group(function () {
    Route::get('/', [StableController::class, 'index'])->name('index');
    Route::get('/{stable}', [StableController::class, 'show'])->name('show');
    Route::get('/{stable}/packages/{package}', [StableController::class, 'packageShow'])->name('packages.show');
});

// Services
Route::prefix('services')->name('services.')->group(function () {
    // Dedicated Horse Reviews Routes
    Route::get('/horse-reviews', [\App\Http\Controllers\HorseReviewController::class, 'index'])->name('horse-reviews.index');
    Route::get('/horse-reviews/{slug}', [App\Http\Controllers\HorseReviewController::class, 'show'])->name('horse-reviews.show');
    Route::get('/photography/{slug}', [App\Http\Controllers\PhotographyController::class, 'show'])->name('photography.show');
});

// Knights (فرساننا)
Route::get('/knights', [App\Http\Controllers\KnightController::class, 'index'])->name('knights.index');
Route::get('/knights/{slug}', [App\Http\Controllers\KnightController::class, 'show'])->name('knights.show');

// Sponsors (الرعاة)
Route::get('/sponsors', [App\Http\Controllers\SponsorController::class, 'index'])->name('sponsors.index');

// Information About pages (معلومات عن)
Route::get('/info/equestrian-sports-overview/{sport_slug}', [App\Http\Controllers\InformationPageController::class, 'showSport'])->name('info.sport.show');
Route::get('/info/{slug}', [App\Http\Controllers\InformationPageController::class, 'show'])->name('info.show');

// Stores
Route::prefix('stores')->name('stores.')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::get('/{store}', [StoreController::class, 'show'])->name('show');
});

// Products
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

// Blog
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs.index');
Route::get('/blogs/{slug}', [PageController::class, 'blogShow'])->name('blogs.show');

// Static Pages
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update', [CartController::class, 'update'])->name('update');
    Route::delete('/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/', [CartController::class, 'clear'])->name('clear');
});

// Compare
Route::prefix('compare')->name('compare.')->group(function () {
    Route::get('/', [App\Http\Controllers\CompareController::class, 'index'])->name('index');
    Route::post('/add', [App\Http\Controllers\CompareController::class, 'add'])->name('add');
    Route::post('/remove', [App\Http\Controllers\CompareController::class, 'remove'])->name('remove');
    Route::post('/toggle', [App\Http\Controllers\CompareController::class, 'toggle'])->name('toggle');
});

// Wishlist
Route::prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [App\Http\Controllers\WishlistController::class, 'index'])->name('index');
    Route::post('/add', [App\Http\Controllers\WishlistController::class, 'add'])->name('add');
    Route::post('/remove', [App\Http\Controllers\WishlistController::class, 'remove'])->name('remove');
    Route::post('/toggle', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('toggle');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
});

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Wishlist
    // Contradicts with the new session-based WishlistController. 
    // If we want auth-only persistence later, we can re-enable or merge.
    // Route::get('/wishlist', [ProfileController::class, 'wishlist'])->name('wishlist');
    // Route::post('/wishlist/add', [ProfileController::class, 'addToWishlist'])->name('wishlist.add');
    // Route::delete('/wishlist/{id}', [ProfileController::class, 'removeFromWishlist'])->name('wishlist.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Booking
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    // Route::get('/book/{service}', [BookingController::class, 'create'])->name('bookings.create');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
        Route::get('/orders/{order}', [ProfileController::class, 'orderShow'])->name('orders.show');
        Route::get('/bookings', [ProfileController::class, 'bookings'])->name('bookings');
        Route::get('/bookings/{booking}', [ProfileController::class, 'bookingShow'])->name('bookings.show');
        Route::put('/bookings/{booking}/cancel', [ProfileController::class, 'cancelBooking'])->name('bookings.cancel');
        Route::get('/horses', [ProfileController::class, 'horses'])->name('horses');
        Route::get('/horses/create', [ProfileController::class, 'createHorse'])->name('horses.create');
        Route::post('/horses', [ProfileController::class, 'storeHorse'])->name('horses.store');
        Route::get('/horses/{horse}/edit', [ProfileController::class, 'editHorse'])->name('horses.edit');
        Route::put('/horses/{horse}', [ProfileController::class, 'updateHorse'])->name('horses.update');
        Route::delete('/horses/{horse}', [ProfileController::class, 'deleteHorse'])->name('horses.delete');
        Route::get('/wallet', [ProfileController::class, 'wallet'])->name('wallet');
        Route::get('/addresses', [ProfileController::class, 'addresses'])->name('addresses');
        Route::post('/addresses', [ProfileController::class, 'storeAddress'])->name('addresses.store');
        Route::put('/addresses/{address}', [ProfileController::class, 'updateAddress'])->name('addresses.update');
        Route::delete('/addresses/{address}', [ProfileController::class, 'deleteAddress'])->name('addresses.delete');
        Route::post('/addresses/{address}/set-default', [ProfileController::class, 'setDefaultAddress'])->name('addresses.set-default');

        Route::get('/conversations', [ProfileController::class, 'conversations'])->name('conversations');
        Route::get('/search-users', [ProfileController::class, 'searchUsers'])->name('search-users');
        Route::post('/conversations/start', [ProfileController::class, 'startConversation'])->name('conversations.start');
        Route::get('/conversations/{conversation}/messages', [ProfileController::class, 'getMessages'])->name('conversations.messages');
        Route::post('/conversations/{conversation}/messages', [ProfileController::class, 'sendMessage'])->name('conversations.send');
    });
});

// Admin Dashboard Routes (custom panel)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Alias route name used by Filament after login to avoid RouteNotFoundException.
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('filament.admin.pages.dashboard');

    Route::resource('services', AdminServiceController::class)->names('services');
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update'])->names('users');
    Route::resource('categories', AdminCategoryController::class)->names('categories');
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'update'])->names('bookings');
});
