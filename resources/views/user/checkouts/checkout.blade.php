@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Checkout</h2>


    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('checkout.placeOrder') }}" method="POST">
        @csrf

        <div class="form-group ">
            <label for="shipping_address_id">Shipping Address</label>
            <select name="shipping_address_id" id="shipping_address_id" class="form-control">
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->full_address }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="payment_type">Payment Type</label>
            <select name="payment_type" id="payment_type" class="form-control">
                <option value="netbanking">Cash on Delivery</option>
                <option value="upi">PayPal</option>
                <option value="cod"> Easypaisa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3 mb-4">Place Order</button>
    </form>
</div>
@endsection
