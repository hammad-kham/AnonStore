@extends('layouts.user')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<main>
    <!-- Shop Page Start -->
    <section class="shop-page">
        <div class="container">
            <!-- Shop Header -->
            <div class="shop-header">
                <h1>Our Shop</h1>
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

            <!-- Filter Modal -->
            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterModalLabel">Filters</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="GET" action="#">
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select id="category" name="category" class="form-control">
                                        <option value="">All Categories</option>
                                        @foreach($shopCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price Range:</label>
                                    <input type="number" id="price_min" name="price_min" class="form-control" placeholder="Min Price">
                                    <input type="number" id="price_max" name="price_max" class="form-control mt-2" placeholder="Max Price">
                                </div>
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row mt-4">
                @forelse($shopProducts as $product)
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
                                <p class="product-card-price">${{ number_format($product->price, 2) }}</p>
                                <div class="product-card-actions">
                                    <a href="#" class="btn btn-outline-secondary"><i class="far fa-heart"></i></a>
                                    <a href="#" class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No products available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Shop Page End -->
</main>
@endsection
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
                    // Default quantity
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
.product-card-price {
    font-size: 1.2rem;
    color: #e74c3c;
}
.product-card-actions a {
    margin-right: 10px;
}
.modal-content {
    padding: 20px;
}
</style>
@endsection
