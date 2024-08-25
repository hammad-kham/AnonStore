<?php

namespace App\Repositories\Eloquent;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\AdminAuthRepositoryInterface;

class AdminAuthRepository implements AdminAuthRepositoryInterface
{
    public function register(array $data)
    {
        //This method creates a new admin user in the database with the provided data
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            //hashed the password
            'password' => bcrypt($data['password']),
        ]);
    }

    public function login(array $credentials)
    {
        //autheticate the admin credentials comming
        //this authe is actual.... while the controller auth chehck what to do if auth is successful both have diffrent roles
        return Auth::guard('admin')->attempt($credentials);
    }

    public function logout()
    {
        //log out using the speific guard admin
        Auth::guard('admin')->logout();
    }
}
