<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Product;


class Category extends Model
{
    use HasFactory, HasApiTokens;

    // Specify the table name
    protected $table = 'categories';

    // Allow mass assignment for the category_name field
    protected $fillable = ['category_name',
        'slug',
        'images'
    
];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    public function product(){
        return $this->hasMany(Product::class, 'category_id');
    }
}


