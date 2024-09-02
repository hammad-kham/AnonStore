<?php
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\CartController;
use App\Http\Controllers\Users\OrderController;
use App\Http\Controllers\Users\CheckoutController;
use App\Http\Controllers\Users\RegisterController;
use App\Http\Controllers\Users\UserPageController;
use App\Http\Controllers\Users\FrontendShopController;
use App\Http\Controllers\Users\UserCategoryController;
use App\Http\Controllers\Users\UserDashboardController;
use App\Http\Controllers\Users\AuthenticationController;

// Routes for authenticated users
// Route::middleware([CheckRole::class . ':user'])->group(function () {
    Route::get('user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
    Route::post('/cart', [CartController::class, 'addProductToCart'])->name('user.cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity']);
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('show.checkout.page');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/order-success/{order}', [OrderController::class, 'orderSuccess'])->name('order.success');
// });

// Routes that don't require role checks
Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/shop', [FrontendShopController::class, 'shop'])->name('user.shop');
Route::get('/shop/{id}', [FrontendShopController::class, 'showProduct'])->name('user.product.show');
Route::get('/order/{id}', [OrderController::class, 'showOrder'])
    ->where('id', '[0-9]+')
    ->name('order.show');

    // routes/web.php

Route::get('/men/products', [UserCategoryController::class, 'showMenProducts'])->name('user.category.men');
Route::get('/women/products', [UserCategoryController::class, 'showWomenProducts'])->name('user.category.women');



