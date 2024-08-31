<?php
use Illuminate\Support\Facades\Route;

//users controller
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Controllers\Users\RegisterController;
//middleware
use App\Http\Controllers\Users\UserDashboardController;
use App\Http\Controllers\Users\AuthenticationController;
use App\Http\Controllers\Users\UserPageController;

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

route::get('/shop', [UserPageController::class,'shop'])->name('user.shop');