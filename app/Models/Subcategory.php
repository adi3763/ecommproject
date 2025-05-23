<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Product;

class Subcategory extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'subcategory_name',
        'category_id',
        'subcategory_slug',
        'subcategory_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}