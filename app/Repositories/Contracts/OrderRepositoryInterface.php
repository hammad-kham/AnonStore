<?php
namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function createOrder(array $data);
    public function findOrderById(int $id);
    public function updateOrder($id, array $data);

    //at admin side....
    public function getAllOrders();
    public function searchOrders($query);
    public function updateOrderStatus($id, $status);
}
