<?php
namespace App\Repositories\Eloquent;


use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        // return Product::all();
        //get images from image tabl
        return Product::with('images')->get();
    }
    

    public function findById(int $id): ?Product
    {
        // return Product::find($id);
        //images from images table
        return Product::with('images')->find($id);
    }

    public function create(array $data): Product
    {
        $product = Product::create($data);
    
         // Handle image uploads
         if (isset($data['images'])) {
            foreach ($data['images'] as $imageFile) {
                $path = $imageFile->store('images', 'public');
                
                if ($path) {
                    $product->images()->create([
                        // Adjusted from 'path' to 'url' to match your Image model
                        'path' => $path, 
                    ]);
                }
            }
        }

        return $product;
    }

    public function update(int $id, array $data): bool
    {
        $product = Product::find($id);

        if ($product) {
            $product->update($data);

            if (isset($data['images'])) {
                // Delete old images
                $product->images()->delete(); 
                
                foreach ($data['images'] as $imageFile) {
                    $path = $imageFile->store('images', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }

            return true;
        }

        return false;
    
    }

    public function delete(int $id): bool
    {
        $product = Product::find($id);

        if ($product) {
            // Delete associated images
            $product->images()->each(function ($image) {
                // Delete image files from storage
                Storage::disk('public')->delete($image->url);
                $image->delete();
            });

            return $product->delete();
        }

        return false;
    }

    public function search($term)
{
    return Product::where('name', 'like', "%{$term}%")->get();
}
    


    public function findWithImages($id)
    {
        return Product::with('images')->findOrFail($id);
    }

}
