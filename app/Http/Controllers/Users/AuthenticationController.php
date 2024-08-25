<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserAuthRepositoryInterface;

class AuthenticationController extends Controller
{
    protected $userRepository;

    public function __construct(UserAuthRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->userRepository->login($credentials)) {
            // dd('$credentials');
            // return redirect()->intended('user/dashboard');
            return redirect()->intended('user/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        $this->userRepository->logout();
        return redirect()->route('login');
    }


}
