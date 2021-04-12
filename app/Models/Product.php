<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'price', 'description', 'product_rate', 'stock', 'weight'];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_category_details', 'product_id', 'category_id');
    }

    public function product_image()
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }
}
