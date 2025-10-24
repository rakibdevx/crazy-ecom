<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];

    // Category
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


    // Variants (One to Many)
    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }

     public function video()
    {
        return $this->hasMany(ProductVideo::class);
    }

}
