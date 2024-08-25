<?php

namespace App\Repositories\Contracts;

interface UserAuthRepositoryInterface
{
    public function register(array $data);

    public function login(array $credentials);

    public function logout();
}