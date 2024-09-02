<?php
namespace App\Repositories\Contracts;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function all();
    public function create(array $data);

    public function find($id);
    public function update($id, array $data);
    
    public function delete($id);
    public function forceDelete($id);
    public function trashed();
    public function restore($id);
    public function search($term);

    //METHODS to shows  category and produxts based on spefdic category in user welcome page...
    public function getCategoryByName(string $name);
    public function getCategoryById(int $id);
    public function getProductsByCategory(Category $category);

}