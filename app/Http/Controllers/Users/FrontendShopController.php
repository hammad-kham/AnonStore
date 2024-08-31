<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class FrontendShopController extends Controller
{

    protected $categoryRepository;
    protected $productRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository,
    ProductRepositoryInterface $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function shop(){
        $shopProducts = $this->productRepository->all();
        $shopCategories = $this->categoryRepository->all();
        return view('user.shop.index',compact('shopProducts','shopCategories'));
    }

    public function showProduct(string $id){
        $product = $this->productRepository->findById($id);
        return view('user.shop.show',compact('product'));
    }
    
}
