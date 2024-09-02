<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    
    public $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        
    }

    public function showMenProducts()
    {
        $menCategory = $this->categoryRepository->getCategoryByName('MEN');
        if (!$menCategory) {
            return redirect()->back()->with('error', 'MEN category not found.');
        }

        $products = $this->categoryRepository->getProductsByCategory($menCategory);

        return view('user.categories.men-category', compact('menCategory', 'products'));
    }


    public function showWomenProducts()
    {
        $womenCategory = $this->categoryRepository->getCategoryByName('WOMEN');
        if (!$womenCategory) {
            return redirect()->back()->with('error', 'WOMEN category not found.');
        }

        $products = $this->categoryRepository->getProductsByCategory($womenCategory);

        return view('user.categories.women-category', compact('womenCategory', 'products'));
    }
}
