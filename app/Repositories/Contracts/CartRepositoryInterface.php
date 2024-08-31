<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
    public function addProductToCart($data);
    public function getByUserId($userId);
    public function removeFromCart($cartId);
}
