@extends('layouts.admin')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Product Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p><strong>Description:</strong> {{ $product->description }}</p>
                                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                <p><strong>Category:</strong> {{ $product->category->name }}</p>
                                <p><strong>Stock:</strong> {{ $product->stock }}</p> <!-- Added stock field -->
                            </div>
                            <div>
                                <strong>Images:</strong>
                                <div class="d-flex flex-column align-items-end">
                                    @forelse ($product->images as $image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->alt }}" class="img-fluid" style="max-width: 200px;">
                                        </div>
                                    @empty
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/images/default-image.png') }}" alt="No Image" class="img-fluid" style="max-width: 200px;">
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
