<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ChatController;


Route::get('/', [UserController::class, 'index'])->name('homepage');
Route::get('/filter', [UserController::class, 'filter'])->name('filter');

Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process-payment');
Route::post('/confirm-overpayment', [PaymentController::class, 'confirmOverpayment'])->name('confirm-overpayment');

Route::post('/like', [ConnectionController::class, 'like'])->name('like');

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat-index');
    Route::get('/chat/{desiredUserId}', [ChatController::class, 'showChat'])->name('chat-show');
    Route::post('/chat/{desiredUserId}', [ChatController::class, 'sendMessage'])->name('chat-send');
});

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::put('/user/update', [UserController::class, 'update'])->name('update-profile');

Route::get('/notification', [NotificationController::class, 'notification'])->name('notification');

Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::delete('/wishlist/{id}', [WishlistController::class, 'deleteWishlist'])->name('delete-wishlist');
Route::delete('/wishlist/friend/{id}', [WishlistController::class, 'deleteFriend'])->name('delete-friend');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::post('/topup', [ShopController::class, 'topup'])->name('topup');
Route::post('/buyAvatar/{avatarId}', [ShopController::class, 'buyAvatar'])->name('buy-avatar');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/set-locale/{locale}', function($locale){
    if(in_array($locale,['en','id'])){
        session(['locale'=>$locale]);
    }
    return redirect()->back();
})->name('set-locale');

Auth::routes();
