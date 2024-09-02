<?php

namespace App\Repositories\Eloquent;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public $categoryObject;

    //model is injected(dependency) and create instance of Category(model) when object is created
    public function __construct(Category $categoryObject)
    {
        $this->categoryObject = $categoryObject;
    }

    public function all()
    {
        //This  returns all the categories stored in the database.
        return $this->categoryObject->all(); 
    }

    public function create(array $data)
    {
        //This  create the categories in the database.
        return $this->categoryObject->create($data); 
    }
    public function find($id)
    {
        //This  find a category with id
        return $this->categoryObject->findOrFail($id); 
    }

    public function update($id, array $data)
    {
        //This  find category with id and then update it
        $category = $this->categoryObject->findOrFail($id); 
        $category->update($data);
        return $category; 
    }

    public function delete($id)
    {
        //find category with id and then delete it.
        $category = $this->categoryObject->findOrFail($id); 
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete(); // Permanently delete the category
    }

    public function trashed()
    {
        return Category::onlyTrashed()->get();
    }

    public function restore($id)
{
    $category = Category::onlyTrashed()->find($id);
    if ($category) {
        $category->restore();
    }
}

public function search($term)
{
    return Category::where('name', 'like', "%{$term}%")->get();
}
    //shows product on category............
public function getCategoryByName(string $name)
{
    return Category::where('name', $name)->first();
}

public function getCategoryById(int $id)
{
    return Category::find($id);
}

public function getProductsByCategory(Category $category)
{
    return $category->products;
}
}