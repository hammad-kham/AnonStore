<?php
use Illuminate\Support\Facades\Route;
//admin middleware
use App\Http\Middleware\AdminAuthMiddleware;
//admin controller class
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\AdminDashboardController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminOrderController;

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
Route::get('admin/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard')->Middleware(AdminAuthMiddleware::class);
//category routes
Route::resource('categories', CategoryController::class);
Route::get('category/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
// Route for restoring trashed categories
Route::put('category/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
Route::delete('category/{id}/force-delete', [CategoryController::class, 'destroyPermanently'])->name('categories.force-delete');
// In routes/web.php
Route::get('category/{id}/products', [ProductController::class, 'filterByCategory'])->name('show.category.product');


//products routes
Route::resource('products', ProductController::class);

// Route::get('admin/products/{product}/edit-stock', [ProductController::class, 'editStock'])->name('products.editStock');

Route::post('admin/products/{product}/update-stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
//manageusers routes
Route::get('dashboard/users', [ManageUsersController::class, 'index'])->name('manage.users.index');



//adminOrderController 


Route::prefix('admin')->name('admin.')->group(function () {
     Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
      Route::get('orders/search', [AdminOrderController::class, 'search'])->name('orders.search');
    Route::post('orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
});
