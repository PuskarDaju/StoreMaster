<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";

    protected $guarded = [];
 

    // Define the relationship with the Product model
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
