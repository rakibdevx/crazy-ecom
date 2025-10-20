<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];

    
     public function category() {
        return $this->belongsTo(Category::class);
    }

    // Sub Category
    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }

    // Child Category
    public function childCategory() {
        return $this->belongsTo(ChildCategory::class);
    }

    // Brand
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    // Colors (Many to Many)
    public function colors() {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id');
    }

    // Sizes (Many to Many)
    public function sizes() {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id');
    }

    // Variants (One to Many)
    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }
}
