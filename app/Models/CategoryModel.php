<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'categories';

    // Allow mass assignment for the category_name field
    protected $fillable = ['category_name'];

    public function subcategories()
    {
        return $this->hasMany(subcategory::class);
    }
}