<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderRepositoryInterface;

class AdminOrderController extends Controller
{
    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    // List all orders
    public function index()
    {
        $orders = $this->orderRepo->getAllOrders();
        return view('admin.orders.index', compact('orders'));
    }

    // Show specific order details
    public function show($id)
    {
        $order = $this->orderRepo->findOrderById($id);
        return view('admin.orders.show', compact('order'));
    }

    // Search for orders
   public function search(Request $request)
{
    $query = $request->input('search');
    $orders = $this->orderRepo->searchOrders($query);
    // dd($query, $orders);
        return view('admin.orders.index', compact('orders', 'query'));
}

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,processing,shipping,delivered,cancelled',
        ]);

        $this->orderRepo->updateOrderStatus($id, $validatedData['status']);

        return redirect()->route('admin.orders.show', $id)->with('success', 'Order status updated successfully.');
    }
}
