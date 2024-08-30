@extends('layouts.admin')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </nav>
        </div>
        <!-- Example content -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Button for creating a new product -->

                    <div class="mb-3">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
                    </div>
                    <!-- Search form -->
                <form method="GET" action="{{ route('products.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ old('search', $search) }}">
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
                                .bg-azureish-white {
                                    background-color: #dbe9f4;
                                }

                                .bg-alice-blue {
                                    background-color: #f0f8ff;
                                }

                                .bg-white {
                                    background-color: #ffffff;
                                }

                                .bg-anti-flash-white {
                                    background-color: #f2f3f4;
                                }

                                .table thead th {
                                    background-color: #dbe9f4;
                                }

                                .img-thumbnail {
                                    width: 100px;
                                    height: auto;
                                }
                            </style>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($product->images->isNotEmpty())
                                                    @foreach ($product->images as $image)
                                                        <img src="{{ asset('storage/backend/images/' . $image->url) }}"
                                                            alt="{{ $product->name }}" class="img-thumbnail"
                                                            style="width: 150px; height: auto;">
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('storage/backend/images/default-image.png') }}"
                                                        alt="No Image" class="img-thumbnail"
                                                        style="width: 150px; height: auto;">
                                                @endif


                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->slug }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                <a href="{{ route('products.show', $product) }}"
                                                    class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>

                                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No products found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                    </div>

                </div>
            </div>
        </section>
    </main>
    <!-- End Main Content -->
@endsection
