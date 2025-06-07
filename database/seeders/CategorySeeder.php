<?php

// database/seeders/CategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Predefined categories
        $categories = [
            ['name' => 'Running Shoes'],
            ['name' => 'Basketball Shoes'],
            ['name' => 'Casual Shoes'],
            ['name' => 'Football Boots'],
            ['name' => 'Lifestyle Sneakers'],
            ['name' => 'CrossFit Shoes'],
            ['name' => 'Training Shoes'],
            ['name' => 'Hiking Shoes'],
            ['name' => 'Cycling Shoes'],
            ['name' => 'Boots'],
            ['name' => 'Skate Shoes'],
            ['name' => 'Sandals'],
            ['name' => 'Flats'],
            ['name' => 'High Heels'],
            ['name' => 'Running Socks'],
            ['name' => 'Compression Wear'],
            ['name' => 'Sports Apparel'],
            ['name' => 'Outdoor Gear'],
            ['name' => 'Gym Equipment'],
            ['name' => 'Bags'],
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
