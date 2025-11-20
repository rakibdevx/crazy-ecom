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

    public function zone() {
        
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

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function averageRating() {
        return $this->comments()->avg('rating') ?? 0;
    }

   public function totalRatings()
{
    return $this->comments()->whereNotNull('rating')->count();
}


    public function ratingCount() {
        return $this->comments()
            ->selectRaw('rating, count(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating');
    }

}





// @php
//     $ratingCounts = $product->ratingCount(); // e.g. [1=>1,2=>0,3=>2,4=>3,5=>10]
// @endphp

// <div class="product-rating">
//     @for ($i = 1; $i <= 5; $i++)
//         @php $count = $ratingCounts[$i] ?? 0; @endphp
//         @if($count > 0)
//             <i class="icon_star" style="color: gold;"></i> {{-- colored star --}}
//         @else
//             <i class="icon_star gray"></i> {{-- gray star --}}
//         @endif
//     @endfor
// </div>
