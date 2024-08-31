@extends('layouts.user')

@section('content')
<div class="container">
    <div class="cart-container">
        <h2>Your Cart</h2>
        @if($carts->isEmpty())
            <div class="empty-cart text-center">
                <h3>Your cart is currently empty</h3>
                <p>It looks like you haven't added any items to your cart yet. Start shopping now and fill your cart with your favorite products!</p>
                <a href="{{ route('user.shop') }}" class="btn btn-primary">Browse Products</a>
            </div>
        @else
            <div class="cart-items">
                @foreach($carts as $cart)
                    <div class="cart-item" id="cart-item-{{ $cart->id }}">
                        <div class="cart-item-details">
                            <div class="cart-item-image">
                                @if($cart->product->image_url)
                                    <img src="{{ asset('images/' . $cart->product->image_url) }}" alt="{{ $cart->product->product_name }}">
                                @else
                                    <img src="{{ asset('images/default-image.png') }}" alt="No Image">
                                @endif
                            </div>
                            <div class="cart-item-info">
                                <h4>{{ $cart->product->product_name }}</h4>
                                <p>${{ $cart->product->price }}</p>
                                <div class="cart-item-quantity">
                                    <input type="number" value="{{ $cart->quantity }}" min="1" data-cart-id="{{ $cart->id }}" class="cart-quantity">
                                </div>
                            </div>
                        </div>
                        <div class="cart-item-total">
                            <p>Total: ${{ $cart->quantity * $cart->product->price }}</p>
                            <button class="btn btn-remove" data-cart-id="{{ $cart->id }}" onclick="removeFromCart({{ $cart->id }})">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-item"><span>Subtotal</span><span>${{ $total }}</span></div>
                <div class="summary-item"><span>Shipping</span><span>Calculated at checkout</span></div>
                <div class="summary-item total"><span>Total</span><span>${{ $total }}</span></div>
                <button class="btn btn-primary btn-block">Proceed to Checkout</button>
            </div>
        @endif
    </div>
</div>

<!-- Link to CSS and JS -->
<link rel="stylesheet" href="{{ asset('anon-assets/css/cart.css') }}">
<script src="{{ asset('anon-assets/js/cart.js') }}"></script>
@endsection
