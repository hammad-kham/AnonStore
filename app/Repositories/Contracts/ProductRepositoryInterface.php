<?php
namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    //return collection 
    public function all(): Collection;

    //maybe null if not found
    public function findById(int $id): ?Product;

    public function create(array $data): Product;

    //return true or false its mean product maybe updated or not
    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function search($term);

    public function findWithImages($id);

}
