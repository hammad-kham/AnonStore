<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AdminAuthRepositoryInterface;

class AdminRegisteredController extends Controller
{
    protected $adminAuthRepository;

    public function __construct(AdminAuthRepositoryInterface $adminAuthRepository)
    {
        $this->adminAuthRepository = $adminAuthRepository;
    }

    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            //email should be unique
            'email' => 'required|string|email|max:255|unique:admins',
            //admin must have to confirm the password
            'password' => 'required|string|min:8|confirmed',
        ]);

        // The line is responsible for creating a new admin by calling the register method on the adminAuthRepository with the required data.
        $this->adminAuthRepository->register($data);

        return redirect()->route('admin.login')->with('success', 'Registration successful! Please log in.');
    }
}
