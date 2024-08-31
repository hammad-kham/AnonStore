<?php
use Illuminate\Support\Facades\Route;

//users controller
use App\Http\Controllers\Users\CartController;
//middleware
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Controllers\Users\RegisterController;
use App\Http\Controllers\Users\UserPageController;
use App\Http\Controllers\Users\FrontendShopController;
use App\Http\Controllers\Users\UserDashboardController;
use App\Http\Controllers\Users\AuthenticationController;

// Routes for authenticated users
Route::get('user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard')->middleware(UserAuthMiddleware::class);
// Other routes for auth


//login routes
Route::get('/login', [AuthenticationController::class,'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
Route::post('register', [RegisterController::class, 'register'])->name('register');
// Logout Route
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
route::get('/', [UserPageController::class,'index'])->name('user.index');
Route::get('/category/{id}', [UserPageController::class, 'show'])->name('category.show');

route::get('/shop', [FrontendShopController::class,'shop'])->name('user.shop');
route::get('shop/{id}', [FrontendShopController::class,'showProduct'])->name('user.product.show');

//carts routes:
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
    
    Route::post('/cart', [CartController::class, 'addProductToCart'])->name('user.cart.add');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity']);


});