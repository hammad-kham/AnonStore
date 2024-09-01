<?php
namespace App\Repositories\Eloquent;

use App\Models\ShippingAddress;
use App\Repositories\Contracts\ShippingAddressRepositoryInterface;

class ShippingAddressRepository implements ShippingAddressRepositoryInterface
{
    public function createShippingAddress(array $data)
    {
        return ShippingAddress::create($data);
    }

    public function getShippingAddressByUserId($userId)
    {
        return ShippingAddress::where('user_id', $userId)->get();
    }
}
