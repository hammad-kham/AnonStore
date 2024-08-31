<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository,CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
}
    
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
  
        $search = $request->input('search');
        
        if ($search) {
            // Search categories based on the search input
            $products = $this->productRepository->search($search);
        } else {
            // Retrieve all categories if no search term is provided
            $products = $this->productRepository->all();
        }
        return view('admin.products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //// Fetch all categories
        $categories = $this->categoryRepository->all(); 
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            // Validation for images
              'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        // Handle image upload
        $images = $request->file('images');
        if ($images) {
            $imagePaths = [];
            foreach ($images as $image) {
                $imagePath = $image->store('images', 'public');
                $imagePaths[] = $imagePath;
            }
        }
        //  $product = $this->productRepository->create($validated);
        $this->productRepository->create($validated);
        
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productRepository->findById($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->categoryRepository->all(); 
        $product = $this->productRepository->findById($id);
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            // Validation for images
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
         // Handle image upload
         $images = $request->file('images');
         if ($images) {
             $imagePaths = [];
             foreach ($images as $image) {
                 $imagePath = $image->store('images', 'public');
                 $imagePaths[] = $imagePath;
             }
             // Store image paths as JSON
             $validated['images'] = json_encode($imagePaths); 
         }
        

        $this->productRepository->update($id, $validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete associated images
        // if ($product->images) {
        //     $imagePaths = json_decode($product->images, true); // Assuming images are stored as JSON
        //     foreach ($imagePaths as $path) {
        //         Storage::disk('public')->delete($path);
        //     }
        // }
        $this->productRepository->delete($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
