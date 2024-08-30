<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    //This setup is used for dependency injection, ensuring that the controller can use the repository methods (all(), create(), find(), etc.) to interact with the Category model. 
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {  $categories = $this->categoryRepository->all();
    //     return view('admin.categories.index',compact('categories'));
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        if ($search) {
            // Search categories based on the search input
            $categories = $this->categoryRepository->search($search);
        } else {
            // Retrieve all categories if no search term is provided
            $categories = $this->categoryRepository->all();
        }

        return view('admin.categories.index', compact('categories', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'parent_id' => 'nullable|exists:categories,id',
        ]);
    
        // Pass only the relevant data to the repository
        $this->categoryRepository->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'parent_id' => $validated['parent_id'] ?? null,
        ]);
    
        // Redirect with success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $categories = $this->categoryRepository->all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->categoryRepository->update($id, $request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      
        $category = $this->categoryRepository->find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function trashed()
    {
        $categories = $this->categoryRepository->trashed();
        return view('admin.categories.trashed', compact('categories'));
    }

    public function destroyPermanently($id)
    {
        $this->categoryRepository->forceDelete($id);
        return redirect()->route('categories.trashed')->with('success', 'Category permanently deleted.');
    }
    public function restore($id)
{
    $category = $this->categoryRepository->restore($id); 
    return redirect()->route('categories.trashed')->with('success', 'Category restored successfully.');
}
}
