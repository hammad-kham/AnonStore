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
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p><strong>Price:</strong> {{ $product->price }}</p>
                        <p><strong>Category:</strong> {{ $product->category->name }}</p>
                        <div>
                            <strong>Images:</strong>
                            <div class="row">
                                @foreach ($product->images as $image)
                                    <div class="col-md-3 mb-2">
                                        <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $image->alt }}" class="img-fluid">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
