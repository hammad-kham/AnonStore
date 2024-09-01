@extends('layouts.admin')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Order Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </nav>
    </div>

    <!-- Example content -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <!-- Search form -->
                <form method="GET" action="{{ route('admin.orders.search') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search orders..." value="{{ old('search', $query ?? '') }}">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <style>
                            .bg-azureish-white { background-color: #dbe9f4; }
                            .bg-alice-blue { background-color: #f0f8ff; }
                            .bg-white { background-color: #ffffff; }
                            .bg-anti-flash-white { background-color: #f2f3f4; }
                            .table thead th { background-color: #dbe9f4; }
                        </style>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Number</th>
                                    <th>User</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Payment Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>${{ number_format($order->net_amount, 2) }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>{{ ucfirst($order->payment_type) }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm">View</a>
                                            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
