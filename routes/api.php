<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HorseController;
use App\Http\Controllers\Api\StableController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::prefix('v1')->group(function () {

    // Auth
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    });

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    // Horses
    Route::get('/horses', [HorseController::class, 'index']);
    Route::get('/horses/{horse}', [HorseController::class, 'show']);

    // Stables
    Route::get('/stables', [StableController::class, 'index']);
    Route::get('/stables/{stable}', [StableController::class, 'show']);
    Route::get('/stables/{stable}/services', [StableController::class, 'services']);

    // Stores & Products
    Route::get('/stores', [StoreController::class, 'index']);
    Route::get('/stores/{store}', [StoreController::class, 'show']);
    Route::get('/stores/{store}/products', [StoreController::class, 'products']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    // Services


    // Content
    Route::get('/sliders', [ContentController::class, 'sliders']);
    Route::get('/blogs', [ContentController::class, 'blogs']);
    Route::get('/blogs/{blog:slug}', [ContentController::class, 'blog']);
    Route::get('/pages/{page:slug}', [ContentController::class, 'page']);
    Route::get('/sponsors', [ContentController::class, 'sponsors']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/user', [AuthController::class, 'user']);
        Route::put('/auth/profile', [AuthController::class, 'updateProfile']);

        // Horses (Owner actions)
        Route::post('/horses', [HorseController::class, 'store']);
        Route::put('/horses/{horse}', [HorseController::class, 'update']);
        Route::delete('/horses/{horse}', [HorseController::class, 'destroy']);

        // Bookings
        Route::get('/bookings', [BookingController::class, 'index']);
        Route::post('/bookings', [BookingController::class, 'store']);
        Route::get('/bookings/{booking}', [BookingController::class, 'show']);
        Route::put('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);

        // Cart
        Route::get('/cart', [CartController::class, 'index']);
        Route::post('/cart/add', [CartController::class, 'add']);
        Route::put('/cart/update', [CartController::class, 'update']);
        Route::delete('/cart/{id}', [CartController::class, 'remove']);
        Route::delete('/cart', [CartController::class, 'clear']);

        // Orders
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders/{order}', [OrderController::class, 'show']);

        // User
        Route::get('/user/addresses', [AuthController::class, 'addresses']);
        Route::post('/user/addresses', [AuthController::class, 'storeAddress']);
        Route::put('/user/addresses/{address}', [AuthController::class, 'updateAddress']);
        Route::delete('/user/addresses/{address}', [AuthController::class, 'deleteAddress']);
        Route::get('/user/wallet', [AuthController::class, 'wallet']);
        Route::get('/user/wishlist', [AuthController::class, 'wishlist']);
        Route::post('/user/wishlist', [AuthController::class, 'addToWishlist']);
        Route::delete('/user/wishlist/{id}', [AuthController::class, 'removeFromWishlist']);
        Route::get('/user/notifications', [AuthController::class, 'notifications']);
    });
});
