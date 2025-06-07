<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
      
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('category.index')->with('success', 'Product created successfully.');
    }

    // Display the specified product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show the form for editing the specified product
    public function edit(Category $category)
    {
       return view('categories.edit',compact('category'));
    }

    // Update the specified product in storage
    public function update(Category $category,Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

    //     if($request->name==null){
    //         return "name is null";
    //     }elseif($category==null){
    //         return "id is null";
    //     }

      $category->update($request->all());
    

        return redirect()->route('category.index')->with('success', 'Product updated successfully.');

    return response()->json([
        'values'=>$category
    ]);
    }

    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
