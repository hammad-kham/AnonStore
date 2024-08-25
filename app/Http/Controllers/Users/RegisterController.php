<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserAuthRepositoryInterface;

class RegisterController extends Controller
{
    protected $userRepository;

    public function __construct(UserAuthRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        // dd($request);
        // Validate the incooming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Pass validated data to repository
        $this->userRepository->register($request->only('name', 'email', 'password', 'phone_number'));

        // Redirect or respond after successful registration
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }



}