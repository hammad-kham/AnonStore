<?php

namespace App\Repositories\Contracts;

interface AdminAuthRepositoryInterface
{
    //methods that must be implemented
    public function register(array $data);

    public function login(array $credentials);
    
    public function logout();
}
