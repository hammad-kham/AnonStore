<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }


       // Show order success page
       public function orderSuccess($orderId)
       {
           $order = $this->orderRepo->findOrderById($orderId);
   
           if (!$order) {
               return redirect()->route('checkout.page')->with('error', 'Order not found.');
           }
           // Eager load order items to ensure they are available
            $order->load('items');
   
           return view('user.orders.order-success', compact('order'));
       }

    public function showOrder($id)
    {
        $order = $this->orderRepo->findOrderById((int)$id);

        if (!$order) {
            abort(404, 'Order not found');
        }

        return view('orders.show', compact('order'));
    }



    
}
