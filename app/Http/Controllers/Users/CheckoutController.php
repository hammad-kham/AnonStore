<?php

namespace App\Http\Controllers\Users;
use App\Mail\OrderPlaced;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use App\Repositories\Contracts\ShippingAddressRepositoryInterface;

class CheckoutController extends Controller
{
    protected $orderRepo;
    protected $orderItemRepo;
    protected $shippingAddressRepo;

    public function __construct(
        OrderRepositoryInterface $orderRepo,
        OrderItemRepositoryInterface $orderItemRepo,
        ShippingAddressRepositoryInterface $shippingAddressRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
        $this->shippingAddressRepo = $shippingAddressRepo;
    }

    // public function showCheckoutPage()
    // {
    //     $user = Auth::user();

    //     if (!$user) {
    //         return redirect()->route('loginForm')->with('error', 'You need to log in to proceed.');
    //     }
        
        

    //     // Fetch user shipping addresses
    //     $addresses = $user->shippingAddresses; 
    //     return view('user.checkouts.checkout', compact('addresses'));
    // }

    public function showCheckoutPage()
{
    // $user = Auth::user();

    if (!$user) {
        return redirect()->route('loginForm')->with('error', 'You need to log in to proceed.');
    }

    // Fetch user shipping addresses
    $addresses = $user->shippingAddresses;

    $emptyAddress = $user->shippingAddresses;

    // Fetch user cart items with product details
    $cartItems = $user->cartItems()->with('product')->get();

    return view('user.checkouts.checkout', compact('addresses', 'cartItems','emptyAddress'));
}




    //Processes the checkout and creates an order
    // public function placeOrder(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'shipping_address_id' => 'required|exists:shipping_addresses,id',
    //         'payment_type' => 'required|in:netbanking,upi,cod',
    //     ]);

    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->back()->with('error', 'User not authenticated.');
    //     }

    //     $cartItems = $user->cartItems()->with('product')->get();

    //     if ($cartItems->isEmpty()) {
    //         return redirect()->back()->with('error', 'Your cart is empty.');
    //     }

    //     $totalAmount = $cartItems->sum(fn($item) => (float)$item->product->price * (int)$item->quantity);
    //     // Example discount logic
    //     $discountAmount = 0; 
    //      // Example shipping cost
    //     $shippingAmount = 10;
    //     $netAmount = $totalAmount - $discountAmount + $shippingAmount;

    //     $orderData = [
    //         'order_number' => strtoupper(uniqid('ORD')),
    //         'user_id' => $user->id,
    //         'total_amount' => $totalAmount,
    //         'discount_amount' => $discountAmount,
    //         'gross_amount' => $totalAmount,
    //         'shipping_amount' => $shippingAmount,
    //         'net_amount' => $netAmount,
    //         'status' => 'placed',
    //         'payment_status' => 'not paid',
    //         'payment_type' => $validatedData['payment_type'],
    //         'payment_transaction_id' => null,
    //     ];
        
    //     $order = $this->orderRepo->createOrder($orderData);

    //     foreach ($cartItems as $item) {
    //         $orderItemData = [
    //             'order_id' => $order->id,
    //             'product_id' => $item->product_id,
    //             'product_name' => $item->product->name,
    //             'color' => $item->product->color ?? null,
    //             'size' => $item->product->size ?? null,
    //             'price' => $item->product->price,
    //             'quantity' => $item->quantity,
    //             'total_amount' => (float)$item->product->price * (int)$item->quantity,
    //         ];

    //         $this->orderItemRepo->createOrderItem($orderItemData);
    //     }

    //     $user->cartItems()->delete();

    //     return redirect()->route('order.success', ['order' => $order->id]);
    // }
    public function placeOrder(Request $request)
{
    $validatedData = $request->validate([
        'shipping_address_id' => 'required|exists:shipping_addresses,id',
        'payment_type' => 'required|in:netbanking,upi,cod',
    ]);

    $user = Auth::user();
    if (!$user) {
        return redirect()->back()->with('error', 'User not authenticated.');
    }

    $cartItems = $user->cartItems()->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    $totalAmount = $cartItems->sum(fn($item) => (float)$item->product->price * (int)$item->quantity);
    $discountAmount = 0;
    $shippingAmount = 10;
    $netAmount = $totalAmount - $discountAmount + $shippingAmount;

    $orderData = [
        'order_number' => strtoupper(uniqid('ORD')),
        'user_id' => $user->id,
        'total_amount' => $totalAmount,
        'discount_amount' => $discountAmount,
        'gross_amount' => $totalAmount,
        'shipping_amount' => $shippingAmount,
        'net_amount' => $netAmount,
        'status' => 'placed',
        'payment_status' => 'not paid',
        'payment_type' => $validatedData['payment_type'],
        'payment_transaction_id' => null,
    ];
    
    $order = $this->orderRepo->createOrder($orderData);

    foreach ($cartItems as $item) {
        $orderItemData = [
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'product_name' => $item->product->name,
            'color' => $item->product->color ?? null,
            'size' => $item->product->size ?? null,
            'price' => $item->product->price,
            'quantity' => $item->quantity,
            'total_amount' => (float)$item->product->price * (int)$item->quantity,
        ];

        $this->orderItemRepo->createOrderItem($orderItemData);
         // Subtract stock
         $product = $item->product;
         $product->stock -= $item->quantity;
         $product->save();
    }

    // Add this code to a route or controller to see available mailers
// dd(config('mail.mailers'));

    // Send the confirmation email when order created
    Mail::to($order->user->email)->send(new OrderPlaced($order));
 
    $user->cartItems()->delete();

    return redirect()->route('order.success', ['order' => $order->id]);
}

    
 


//for testing purpose
// public function testCartItems()
// {
//     $user = Auth::user(); // Ensure user is authenticated

//     if (!$user) {
//         return response()->json(['error' => 'User not authenticated.'], 401);
//     }

//     // Fetch cart items with product details
//     $cartItems = $user->cartItems()->with('product')->get();

//     // Debugging: Log or return cart items to check data
//     Log::info('Cart Items:', $cartItems->toArray());

//     return response()->json($cartItems);
// }

    

}
