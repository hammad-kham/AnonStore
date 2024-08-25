<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
 
    public function dashboard()
    {
        return view('user.dashboard');
    }
}
