@extends('layouts.user')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<main>
    <!-- Shop Page Start -->
    <section class="shop-page">
        <div class="container">
            <!-- Shop Header -->
            <div class="shop-header">
                <h1>Women's Collection</h1>
                <div class="shop-controls d-flex justify-content-between align-items-center">
                    <!-- Sorting Options -->
                    <div class="sort-options">
                        <label for="sort">Sort by:</label>
                        <select id="sort" name="sort" class="form-control">
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="newest">Newest Arrivals</option>
                            <option value="popularity">Popularity</option>
                        </select>
                    </div>
                    <!-- Filter Button -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#filterModal">Filters</button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row mt-4">
                @forelse($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="product-card">
                            <div class="product-card-image">
                                <a href="{{ route('user.product.show', $product->id) }}">
                                    @if ($product->images->isNotEmpty())
                                        @foreach ($product->images as $image)
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" class="img-fluid">
                                            @break  <!-- Display only the first image -->
                                        @endforeach
                                    @else
                                        <img src="{{ asset('storage/images/default-image.png') }}" alt="No Image" class="img-fluid">
                                    @endif
                                </a>
                            </div>
                            <div class="product-card-body">
                                <h4 class="product-card-title">
                                    <a href="{{ route('user.product.show', $product->id) }}">{{ $product->name }}</a>
                                </h4>
                                
                                <div class="d-flex justify-content-between align-items-center price-stock-wrapper">
                                    <p class="product-card-price mb-0">{{ number_format($product->price, 2) }}</p>
                                    @if($product->stock > 0)
                                        <p class="product-card-stock mb-0 text-success">In Stock: {{ $product->stock }}</p>
                                    @else
                                        <p class="product-card-stock mb-0 text-danger">Out of Stock</p>
                                    @endif
                                </div>

                                <div class="product-card-actions mt-3">
                                    <a href="#" class="btn btn-outline-secondary btn-outline-info"><i class="far fa-heart"></i></a>
                                    @if($product->stock > 0)
                                        <a href="#" class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">
                                            <i class="fas fa-cart-plus"></i> Add to Cart
                                        </a>
                                    @else
                                        <button class="btn btn-secondary" disabled>Out of Stock</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No products available in the Women's category.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Shop Page End -->
</main>
@endsection

@section('styles')
<style>
.shop-page {
    padding: 30px 0;
}

.shop-header {
    margin-bottom: 20px;
}

.shop-controls {
    margin-top: 10px;
}

.sort-options {
    margin-right: 15px;
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.product-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.product-card-image img {
    width: 100%;
    height: auto;
}

.product-card-body {
    padding: 15px;
}

.product-card-title a {
    color: #333;
    text-decoration: none;
    font-size: 1.1rem;
    display: block;
    margin-bottom: 10px;
}

.price-stock-wrapper {
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.product-card-price {
    font-size: 1.2rem;
    color: #e74c3c;
    margin-right: auto;
}

.product-card-stock {
    font-size: 1rem;
    margin-left: 10px;
    color: #28a745;
}

.product-card-stock.text-danger {
    color: #e74c3c;
}

.product-card-actions a {
    margin-right: 10px;
}

.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const productId = this.getAttribute('data-product-id');
                const userId = {{ Auth::id() }};

                fetch('{{ route('user.cart.add') }}', { 
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        product_id: productId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Product added to cart successfully!');
                    } else {
                        alert('Failed to add product to cart.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection
