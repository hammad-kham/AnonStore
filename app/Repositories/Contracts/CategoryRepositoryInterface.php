<?php
namespace App\Repositories\Contracts;

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

}