<?php
namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $data)
    {
        return Order::create($data);
    }

    public function findOrderById(int $id)
    {
        return Order::find($id);
    }
    
    public function updateOrder($id, array $data)
    {
        $order = Order::find($id);
        $order->update($data);
        return $order;
    }

    //admin side
    public function getAllOrders()
    {
        return Order::with('user')->paginate(10); // Eager loading user relation
    }

    public function searchOrders($query)
    {
        return Order::where('order_number', 'LIKE', "%{$query}%")
                    ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%");
                    })
                    ->with('user')
                    ->paginate(10);
    }

    public function updateOrderStatus($id, $status)
    {
        $order = $this->findOrderById($id);
        $order->status = $status;
        $order->save();
        return $order;
    }
}
