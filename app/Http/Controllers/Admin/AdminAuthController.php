<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\AdminAuthRepositoryInterface;

class AdminAuthController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminAuthRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        //Retrieving User Credentials
        $credentials = $request->only('email', 'password');
        // dd($credentials);

        //attemp auth on credentials
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        //if not match return false with error
        return back()->withErrors([
            'email' => 'ops! Incorrect Credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        //when you need to directly control which guard is being logged out.use this method
        Auth::guard('admin')->logout();

        // Invalidate the session
        $request->session()->invalidate();
        // regenerate the CSRF toke
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
