<?php
use Illuminate\Support\Facades\Route;

//users controller
use App\Http\Controllers\Users\OrderController;
//middleware
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Controllers\Users\CartController;
use App\Http\Controllers\Users\CheckoutController;
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
// route::get('/', [UserPageController::class,'index'])->name('user.index');
// Route::get('/category/{id}', [UserPageController::class, 'show'])->name('category.show');


//frontenfController routes
route::get('/shop', [FrontendShopController::class,'shop'])->name('user.shop');
route::get('/shop/{id}', [FrontendShopController::class,'showProduct'])->name('user.product.show');


    //order controller
    Route::get('/order/{id}', [OrderController::class, 'showOrder'])
    ->where('id', '[0-9]+')
    ->name('order.show');



//carts routes:
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
    
    Route::post('/cart', [CartController::class, 'addProductToCart'])->name('user.cart.add');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity']);
});
//for testing purpose......
// Route::get('/test-cart-items', [CheckoutController::class, 'testCartItems']);

//checkout

// Display the checkout page
// Route::get('/shop/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('show.checkout.page');

// Handle the checkout process
// Route::post('/shop/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

// Route to show order success page
// Route::get('/order/success/{order}', [CheckoutController::class, 'orderSuccess'])->name('order.success');

Route::middleware(['auth'])->group(function () {
  Route::get('/checkoutt', [CheckoutController::class, 'showCheckoutPage'])->name('show.checkout.page');
  Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
  Route::get('/order-success/{order}', [OrderController::class, 'orderSuccess'])->name('order.success');
});
