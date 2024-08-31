<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository,
    ProductRepositoryInterface $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
       
        $categories = $this->categoryRepository->all();
        return view('layouts.user', compact('categories'));
    }

    public function shop(){
        // $shop = $this->productRepository->all();
        return view('user.shop');
    }
    
}
