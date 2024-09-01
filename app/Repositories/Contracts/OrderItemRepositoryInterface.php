<?php
namespace App\Repositories\Contracts;

interface OrderItemRepositoryInterface
{
    public function createOrderItem(array $data);
    public function findOrderItemById($id);
    public function updateOrderItem($id, array $data);
}
