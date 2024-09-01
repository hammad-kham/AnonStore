@extends('layouts.user')

@section('content')
<main>
    <!-- Single Product Page Start -->
    <section class="single-product-page py-5">
        <div class="container">
            <div class="row">
                <!-- Product Image Gallery -->
                <div class="col-lg-6">
                    <div class="product-image-gallery">
                        <!-- Main Image -->
                        <img src="{{ asset('backend/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid main-image">
                        @if($product->images->count() > 1)
                            <div class="product-thumbnails mt-2">
                                @foreach($product->images as $image)
                                    <img src="{{ asset('backend/images/' . $image->path) }}" alt="{{ $product->name }}" class="img-thumbnail">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <p class="product-price">${{ number_format($product->price, 2) }}</p>
                        <p class="product-description">{{ $product->description }}</p>
                        <div class="product-actions mt-4">
                            <a href="#" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Add to Cart</a>
                            <a href="#" class="btn btn-outline-secondary"><i class="far fa-heart"></i> Add to Wishlist</a>
                        </div>
                        <div class="product-meta mt-4">
                            <p><strong>Category:</strong> {{ $product->category->name }}</p>
                            <p><strong>SKU:</strong> {{ $product->sku }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Product Page End -->
</main>
@endsection

@section('styles')
<style>
.single-product-page {
    background-color: #f9f9f9;
    padding: 30px 0;
}

.product-image-gallery {
    position: relative;
    padding-right: 10px;
}

.main-image {
    width: 100%;
    height: auto;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.product-thumbnails {
    display: flex;
    gap: 10px;
}

.product-thumbnails img {
    width: 80px;
    height: auto;
    cursor: pointer;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.product-thumbnails img:hover {
    border-color: #1a2224;
}

.product-details {
    padding-left: 20px;
}

.product-title {
    font-size: 2rem;
    margin-bottom: 10px;
}

.product-price {
    font-size: 1.5rem;
    color: #e74c3c;
    margin-bottom: 10px;
}

.product-description {
    font-size: 1rem;
    margin-bottom: 20px;
}

.product-actions a {
    margin-right: 10px;
}

.product-meta p {
    margin: 0;
    font-size: 0.9rem;
}
</style>
@endsection
