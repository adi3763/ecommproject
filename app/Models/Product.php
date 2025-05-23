<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductImage;

class Product extends Model
{
    //
   protected $fillable = [
    'productname',
    'product_price',
    'product_discription',
    'product_quantity',
    'product_size',
    'category_id',
    'subcategory_id',
];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function productImage(){
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
