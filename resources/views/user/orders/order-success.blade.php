@extends('layouts.user')

@section('content')
<div class="container mt-2 mb-2">
    <div class="card bg-light"> <!-- Use 'bg-light' for a subtle background color -->
        <div class="card-body text-center">
            <div class="icon my-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 10.97l-3.5-3.5a.75.75 0 0 1 1.07-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6a.75.75 0 0 1-1.06 0z"/>
                </svg>
            </div>
            <h2 class="card-title">Order Confirmation</h2>
            <p class="lead">Thank you for your order!</p>
            <p class="font-weight-bold">Order Number: <span class="text-primary">{{ $order->order_number }}</span></p>
            <p class="font-weight-bold">Order Total: <span class="text-primary">{{ number_format($order->net_amount, 2) }}</span></p>
            
            <hr>
            
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Order Details</h5>

                            @if($order->items && $order->items->isNotEmpty())
                                <ul class="list-group list-group-flush">
                                    @foreach($order->items as $item)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <strong>{{ $item->product_name }}</strong><br>
                                                    Quantity: {{ $item->quantity }}<br>
                                                </div>
                                                <div class="text-right">
                                                    Price: {{ number_format($item->price, 2) }}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No items found in this order.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('user.shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection
