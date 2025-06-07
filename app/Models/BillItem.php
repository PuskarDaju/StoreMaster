<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $guarded=[];
    protected $table='bill_items';

    public function product()
{
    return $this->belongsTo(Product::class);
}
}
