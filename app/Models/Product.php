<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{



    protected $fillable = ['id','name', 'category_id', 'price', 'stock_quantity'];

    

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with the StockHistory model
    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }
}
