<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Sample Product',
            'slug' => 'sample-product',
            'description' => 'This is a sample product description.',
            'price' => 99.99,
            'category_id' => 1,
        ]);
        // Generate multiple products using the factory
        // Product::factory()->count(50)->create();
    }
}
