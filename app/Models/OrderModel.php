<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
