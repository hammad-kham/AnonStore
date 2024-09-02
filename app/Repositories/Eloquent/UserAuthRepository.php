<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserAuthRepositoryInterface;

class UserAuthRepository implements UserAuthRepositoryInterface
{
    // public function register(array $data)
    // {
    //     $roleId = Role::where('role', 'user')->first()->id;
    //     // dd($data);
    //     //create a new user
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //         'role_id' => $roleId,
    //     ]);
    // }

    public function register(array $data)
{
    // Fetch the role
    $role = Role::where('role', 'user')->first();
    
    // Handle case where the role is not found
    if (!$role) {
        throw new \Exception('Role "user" not found.');
    }

    $roleId = $role->id;

    // Create and return a new user
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role_id' => $roleId,
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
