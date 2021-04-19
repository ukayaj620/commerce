<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'price', 'description', 'product_rate', 'stock', 'weight'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function product_image()
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'product_carts', 'product_id', 'cart_id');
    }
}
