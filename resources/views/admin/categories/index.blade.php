@extends('layouts.admin')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Category Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </nav>
    </div>

    <!-- Example content -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <!-- Buttons for various actions -->
                <div class="mb-3">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
                    <a href="{{ route('categories.trashed') }}" class="btn btn-secondary">View Trashed Categories</a>
                </div>

                <!-- Search form -->
                <form method="GET" action="{{ route('categories.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ old('search', $search) }}">
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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Parent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                                            
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No categories found.</td>
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
