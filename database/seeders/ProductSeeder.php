<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Assuming categories already exist in the categories table
        $categories = Category::all();

        // List of 30 products with actual data
        $products = [
            ['name' => 'Nike Air Max 2021', 'category_id' => $categories->random()->id, 'price' => 120.50, 'stock_quantity' => 50],
            ['name' => 'Adidas UltraBoost', 'category_id' => $categories->random()->id, 'price' => 150.00, 'stock_quantity' => 30],
            ['name' => 'Puma Running Shoes', 'category_id' => $categories->random()->id, 'price' => 90.00, 'stock_quantity' => 40],
            ['name' => 'Reebok CrossFit', 'category_id' => $categories->random()->id, 'price' => 100.00, 'stock_quantity' => 25],
            ['name' => 'Converse Chuck Taylor', 'category_id' => $categories->random()->id, 'price' => 55.00, 'stock_quantity' => 60],
            ['name' => 'Asics Gel Nimbus', 'category_id' => $categories->random()->id, 'price' => 130.00, 'stock_quantity' => 35],
            ['name' => 'Vans Old Skool', 'category_id' => $categories->random()->id, 'price' => 60.00, 'stock_quantity' => 80],
            ['name' => 'New Balance 990v5', 'category_id' => $categories->random()->id, 'price' => 180.00, 'stock_quantity' => 50],
            ['name' => 'Under Armour HOVR', 'category_id' => $categories->random()->id, 'price' => 120.00, 'stock_quantity' => 45],
            ['name' => 'Nike Air Force 1', 'category_id' => $categories->random()->id, 'price' => 90.00, 'stock_quantity' => 70],
            ['name' => 'Adidas NMD', 'category_id' => $categories->random()->id, 'price' => 140.00, 'stock_quantity' => 50],
            ['name' => 'Brooks Ghost 14', 'category_id' => $categories->random()->id, 'price' => 110.00, 'stock_quantity' => 60],
            ['name' => 'Saucony Triumph 18', 'category_id' => $categories->random()->id, 'price' => 120.00, 'stock_quantity' => 55],
            ['name' => 'Skechers GoRun', 'category_id' => $categories->random()->id, 'price' => 70.00, 'stock_quantity' => 100],
            ['name' => 'Hoka One One Clifton 8', 'category_id' => $categories->random()->id, 'price' => 160.00, 'stock_quantity' => 40],
            ['name' => 'Nike React Infinity Run', 'category_id' => $categories->random()->id, 'price' => 130.00, 'stock_quantity' => 50],
            ['name' => 'Adidas Predator 20.3', 'category_id' => $categories->random()->id, 'price' => 80.00, 'stock_quantity' => 50],
            ['name' => 'Puma Future 5.1', 'category_id' => $categories->random()->id, 'price' => 110.00, 'stock_quantity' => 30],
            ['name' => 'Reebok Zig Kinetica', 'category_id' => $categories->random()->id, 'price' => 95.00, 'stock_quantity' => 45],
            ['name' => 'Converse One Star', 'category_id' => $categories->random()->id, 'price' => 50.00, 'stock_quantity' => 80],
            ['name' => 'Nike Zoom Freak 1', 'category_id' => $categories->random()->id, 'price' => 135.00, 'stock_quantity' => 55],
            ['name' => 'Adidas Yeezy Boost 350', 'category_id' => $categories->random()->id, 'price' => 220.00, 'stock_quantity' => 30],
            ['name' => 'Vans Authentic', 'category_id' => $categories->random()->id, 'price' => 50.00, 'stock_quantity' => 90],
            ['name' => 'New Balance 327', 'category_id' => $categories->random()->id, 'price' => 85.00, 'stock_quantity' => 65],
            ['name' => 'Asics Gel Kayano', 'category_id' => $categories->random()->id, 'price' => 150.00, 'stock_quantity' => 40],
            ['name' => 'Reebok Club C 85', 'category_id' => $categories->random()->id, 'price' => 75.00, 'stock_quantity' => 70],
            ['name' => 'Nike Air Zoom Pegasus', 'category_id' => $categories->random()->id, 'price' => 120.00, 'stock_quantity' => 50],
            ['name' => 'Adidas Superstar', 'category_id' => $categories->random()->id, 'price' => 85.00, 'stock_quantity' => 60],
            ['name' => 'Puma Clyde Court', 'category_id' => $categories->random()->id, 'price' => 95.00, 'stock_quantity' => 50],
        ];

        // Insert the products into the database
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
