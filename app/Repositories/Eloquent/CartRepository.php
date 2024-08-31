<?php
namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\Contracts\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{


    public function addProductToCart($data)
    {
        // Find the cart item if it exists
        $cartItem = Cart::where('user_id', $data['user_id'])
                        ->where('product_id', $data['product_id'])
                        ->first();
    
        if ($cartItem) {
            // Update the quantity if it exists
            $cartItem->quantity += $data['quantity'];
            $cartItem->save();
        } else {
            // Create a new cart item if it doesn't exist
            $cartItem = Cart::create([
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity']
            ]);
        }
    
        return $cartItem;
    }
    

public function getByUserId($userId)
{
    return Cart::where('user_id', $userId)->with('product')->get();
}

// Remove a product from the cart by cart ID
    // Remove a product from the cart by cart ID
    public function removeFromCart($cartId)
    {
        $cartItem = Cart::find($cartId);

        if ($cartItem) {
            $cartItem->delete();
            return true;
        }

        return false;
    }
    


}
