<?php
namespace App\Repositories\Eloquent;

use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemRepositoryInterface;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function createOrderItem(array $data)
    {
        return OrderItem::create($data);
    }

    public function findOrderItemById($id)
    {
        return OrderItem::find($id);
    }

    public function updateOrderItem($id, array $data)
    {
        $orderItem = $this->findOrderItemById($id);
        if ($orderItem) {
            $orderItem->update($data);
            return $orderItem;
        }
        return null;
    }
}
