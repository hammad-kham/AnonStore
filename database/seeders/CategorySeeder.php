<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices and gadgets', 'parent_id' => null],
            ['name' => 'Computers', 'description' => 'Desktops, laptops, and accessories', 'parent_id' => 1],
            ['name' => 'Smartphones', 'description' => 'Mobile phones and accessories', 'parent_id' => 1],
            ['name' => 'Home Appliances', 'description' => 'Appliances for home use', 'parent_id' => null],
            ['name' => 'Furniture', 'description' => 'Home and office furniture', 'parent_id' => null],
            ['name' => 'Books', 'description' => 'Various kinds of books', 'parent_id' => null],
            ['name' => 'Clothing', 'description' => 'Apparel and clothing items', 'parent_id' => null],
            ['name' => 'Sports Equipment', 'description' => 'Gear and equipment for sports', 'parent_id' => null],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'parent_id' => $category['parent_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
