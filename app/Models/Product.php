<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['product_name', 'category_id', 'selling_price', 'buy_price', 'stock', 'stock_min', 'unit', 'weight', 'storage_location', 'description', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}