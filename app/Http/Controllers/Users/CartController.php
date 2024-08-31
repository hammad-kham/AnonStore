<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\CartRepositoryInterface;

class CartController extends Controller
{
    protected $cartRepo;

    public function __construct(CartRepositoryInterface $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    /**
     * Display the cart for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login'); // Redirect if not authenticated
        }
    
        $carts = $this->cartRepo->getByUserId($userId);
    
        $total = $carts->sum(function($cart) {
            return $cart->quantity * $cart->product->price;
        });
    
        return view('user.carts.index', compact('carts', 'total'));
    }

    //add to cart

    public function addProductToCart(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Add product to cart logic
        $cart = $this->cartRepo->addProductToCart($data);
    
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function remove($id)
    {
        $result = $this->cartRepo->removeFromCart($id);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }
    }
    
    

    


}
