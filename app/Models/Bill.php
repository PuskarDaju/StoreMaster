<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded=[];
    protected $table='bills';

    public function items()
{
    return $this->hasMany(BillItem::class);
}
}
