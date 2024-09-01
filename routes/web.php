<?php

// Load user routes
require base_path('routes/user.php');

// Load admin routes
require base_path('routes/admin.php');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\FrontendShopController;



Route::get('/', [FrontendShopController::class,'index'])->name('home');


