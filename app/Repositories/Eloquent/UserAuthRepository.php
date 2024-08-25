<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserAuthRepositoryInterface;

class UserAuthRepository implements UserAuthRepositoryInterface
{
    public function register(array $data)
    {
        // dd($data);
        //create a new user
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => 'active',
        ]);
    }


    public function login(array $credentials)
    {
        //check user exist or not.. it return true or false
        return Auth::attempt($credentials);
    }

    public function logout()
    {
        Auth::logout();
    }
}
