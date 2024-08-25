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
        // dd($request);
        $credentials = $request->only('email', 'password');

        //Ths is responsible for attempting to log in a user by calling the login method on the userRepository with the provided credentials. If the login is successful, the subsequent code block will be executed.
        if ($this->userRepository->login($credentials)) {
            // dd('$credentials');
            return redirect()->intended('user/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        //This line is calling the logout method on an instance of the UserAuthRepository class.
        $this->userRepository->logout();
        return redirect()->route('login');
    }


}
