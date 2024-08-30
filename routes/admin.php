<?php
use Illuminate\Support\Facades\Route;
//admin middleware
use App\Http\Middleware\AdminAuthMiddleware;
//admin controller class
use App\Http\Controllers\Admin\AdminAuthController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;

    //admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });

    // Admin Registration Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('register', function () {
        abort(404);
    });
    //routes are disable because i want admin to add through tinker..
    // Route::post('register', [AdminRegisteredController::class, 'register'])->name('SubmitForm');
    // Route::get('register', [AdminRegisteredController::class, 'showRegistrationForm'])->name('register');
   
});
//routes with middlewares
Route::get('admin/dashboard',[AdminDashboardController::class, 'index'])->Middleware(AdminAuthMiddleware::class);
//category routes
Route::resource('categories', CategoryController::class);

Route::get('category/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
// Route for restoring trashed categories
Route::put('category/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');

Route::delete('category/{id}/force-delete', [CategoryController::class, 'destroyPermanently'])->name('categories.force-delete');

