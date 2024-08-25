<?php

namespace App\Repositories\Contracts;

interface UserAuthRepositoryInterface
{
    //method must be implement
    public function register(array $data);

        public function login(array $credentials);

    public function logout();
}