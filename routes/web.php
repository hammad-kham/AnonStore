<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Controllers\Users\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Users\UserDashboardController;
use App\Http\Controllers\Users\AuthenticationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('admin/dashboard',[DashboardController::class, 'index']);



//Routes for authenticated users
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

