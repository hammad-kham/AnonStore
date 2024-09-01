@extends('layouts.admin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item "><a href="{{route('admin.orders.index')}}">Orders</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </nav>
        </div>

        <!-- Add your page content here -->
        <!-- Example content -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <h1>Order Details</h1>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Order #{{ $order->order_number }}</h5>
                            <p>User: {{ $order->user->name }}</p>
                            <p>Total Amount: {{ number_format($order->net_amount, 2) }}</p>
                            <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>

                            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST"
                                class="form-inline">
                                @csrf
                                <div class="form-group">
                                    <label for="status" class="mr-4 mt-2">Update Status</label>
                                    <select name="status" id="status" class="form-control mr-2 mt-2">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                            Processing</option>
                                        <option value="shipping" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                        </option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                            Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-success mt-3">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Items</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($order->items as $item)
                                    <li class="list-group-item">
                                        <strong>{{ $item->product_name }}</strong><br>
                                        Quantity: {{ $item->quantity }}<br>
                                        Price: {{ number_format($item->price, 2) }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
        </section>

    </main>
    <!-- End Main Content -->
@endsection
