<?php

// Load user routes
require base_path('routes/user.php');

// Load admin routes
require base_path('routes/admin.php');

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
})->name('home');

