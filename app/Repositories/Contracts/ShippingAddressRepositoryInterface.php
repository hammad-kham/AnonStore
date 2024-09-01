<?php
namespace App\Repositories\Contracts;

interface ShippingAddressRepositoryInterface
{
    public function createShippingAddress(array $data);
    public function getShippingAddressByUserId($userId);
}
