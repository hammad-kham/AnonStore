<?php
use Illuminate\Support\Facades\Route;

//users controller
use App\Http\Controllers\Users\AuthenticationController;
use App\Http\Controllers\Users\RegisterController;
use App\Http\Controllers\Users\UserDashboardController;
//middleware
use App\Http\Middleware\UserAuthMiddleware;


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

